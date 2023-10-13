from flask import Flask, request, jsonify,render_template,redirect,url_for
from flask_sqlalchemy import SQLAlchemy
import pickle
import numpy as np
from urllib.parse import quote_plus
import tensorflow as tf
from tensorflow.keras.preprocessing.text import Tokenizer
from tensorflow.keras.preprocessing.sequence import pad_sequences
from keras.layers import Embedding
from keras.models import Sequential
from keras import layers
import numpy as np

# Create a Flask app
app = Flask(__name__)

app.config['SQLALCHEMY_DATABASE_URI'] = "mysql://root:@localhost/ref_sys"
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
db = SQLAlchemy(app)


# Define the Sentiment model for the database

class Sentiment(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    candidate_name = db.Column(db.String(100), db.ForeignKey('candidates.first_name'))
    response = db.Column(db.String(500))
    positive = db.Column(db.Float)
    neutral = db.Column(db.Float)
    negative = db.Column(db.Float)
    #candidate = db.relationship('candidates', backref='sentiment')

    
    def __init__(self, candidate_name, response, positive, neutral, negative):
        self.candidate_name = candidate_name
        self.response = response
        self.positive = positive
        self.neutral = neutral
        self.negative = negative

class Scores(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    candidate_name = db.Column(db.String(100), db.ForeignKey('candidates.first_name'))
    respondent= db.Column(db.String(50))
    communication_skills = db.Column(db.Float)
    creativity = db.Column(db.Float)
    problem_solving = db.Column(db.Float)
    reliability = db.Column(db.Float)
    team_work = db.Column(db.Float)
    time_management = db.Column(db.Float)
    willingness_to_learn = db.Column(db.Float)

    def __init__(self, candidate_name, communication_skills, creativity, problem_solving, reliability, team_work, time_management, willingness_to_learn):
        self.candidate_name = candidate_name
        self.communication_skills = communication_skills
        self.creativity = creativity
        self.problem_solving = problem_solving
        self.reliability = reliability
        self.team_work = team_work
        self.time_management = time_management
        self.willingness_to_learn = willingness_to_learn
         
# Create the database tables
with app.app_context():
    db.create_all()

with open("sentimentmodel.pkl","rb") as binary:
    model=pickle.load(binary)
# model = tf.keras.models.load_model('sentimentmodel.pkl')
    
def preprocess_input(user_input):
    #-----------------------------------------------------------
    max_words = 10000
    max_len = 200
    comments=user_input
    #-----------------------------------------------------------
    tokenizer = Tokenizer(num_words=max_words)
    tokenizer.fit_on_texts(comments)
    sequences = tokenizer.texts_to_sequences(comments)
    padded_sequences = pad_sequences(sequences, maxlen=max_len)
    #-----------------------------------------------------------
    return padded_sequences

def make_predictions(response):
    data=preprocess_input(response)
    sentiment = model.predict(data)
    return sentiment

def classify_sentiment(user_input):
    predictions=make_predictions(user_input)
    index=np.argmax(predictions,axis=1)
    # Map predicted classes to sentiment labels
    sentiment_labels = ['positive', 'negative', 'neutral']
    predicted_sentiments = [sentiment_labels[i] for i in index]
    #most_common_sentiment = mode(predicted_sentiments)
    #return most_common_sentiment
    total_labels=len(predicted_sentiments)
    classes={label:0 for label in sentiment_labels}
    for prediction in predicted_sentiments:
        classes[prediction]+=1
    for label in classes:
        classes[label]=100*classes[label]/total_labels
    return classes

# def classify_sentiment(comment):
#     arr=np.array([comment])
#     probabilities = model.predict(arr)[0]
#     labels=['negative','positive','neutral']
#     return dict(zip(labels,probabilities))

@app.route("/",methods=['GET'])
def index():
    return render_template('questionaire.html') 

@app.route('/predict/<candidate_name>/<respondent>',methods=['POST'])
def predict(candidate_name,respondent):
    opinion = request.form.get("opinion")
    scores_={
        "problem_solving":request.form.get("problem_solving"),
        "communication_skills":request.form.get("communication_skills"),
        "time_management":request.form.get("time_management"),
        "creativity":request.form.get("creativity"),
        "willingness_to_learn":request.form.get("willingness_to_learn"),
        "team_work":request.form.get("team_work"),
        "reliability":request.form.get("reliability")
    }
    # Preprocess the input data (if required)
    # ...
    # Perform prediction using the loaded model
    sentiment= classify_sentiment(opinion)
    sentiments={'response':opinion,'candidate_name':candidate_name ,'respondent':respondent,**sentiment}
    scores={'candidate_name':candidate_name,**scores_}
    # Save the response and sentiment to the database
    sentiment_entry = Sentiment(**sentiments)
    scores=Scores(**scores_)
    db.session.add(sentiment_entry)
    db.session.add(scores)
    db.session.commit()
    # Return the response as JSON
    """return jsonify({
        'status': 'success',
        'message': 'Response successfully recorded'
    })"""
    return redirect(url_for('thank_you'))

# Define the route for model prediction and saving to the database
@app.route("/",methods=['GET'])
def index():
    return render_template('questionaire.html') 

@app.route("/thank_you",methods=['GET'])
def thank_you():
    return render_template('thank_you.html')
    

@app.route('/report',methods=['GET'])
def report():
    return render_template('Candidate Reports.html')

@app.route('/candidateData')#/<candidateName>')
def getCandidateData(candidateName):
    imageName="profile-img.jpg"
    data:dict={
        candidateName:{
        'sentiments':{
            'positive':75,
            'neutral':20,
            'negative':5
        },
        'conclusion':'suitable',
        'analytics':{
                'individual_scores':{
                'bakertilly':[65, 59, 90, 81, 56, 55, 40],
                'econet':[240, 100,45,100,200,100, 100]
                },
                'average_scores':[30, 100,100,100,200,100, 100]
            },
        'email':'martinmuduva@baker.co.zw',
        'role':'Designer',
        'phone':'+263 713 859 053',
        'img':"/static/assets/img/{}".format(imageName),
        'references':['bakertilly','econet']
        }
    }
    return jsonify(data)

# Define the main entry point of the application
if __name__ == '__main__':
    # Run the Flask app
    app.run(debug=True)