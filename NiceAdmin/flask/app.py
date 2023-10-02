from flask import Flask, request, jsonify,render_template
from flask_sqlalchemy import SQLAlchemy
import pickle
import numpy as np
from urllib.parse import quote_plus

# Create a Flask app
app = Flask(__name__)

app.config['SQLALCHEMY_DATABASE_URI'] = "mysql://root:@localhost/ref_sys"
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
db = SQLAlchemy(app)

# Define the Sentiment model for the database

class Sentiment(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    response = db.Column(db.String(500))
    positive = db.Column(db.Float)
    negative=db.Column(db.Float)
    neutral = db.Column(db.Float)
    
    def __init__(self, response, positive,negative,neutral):
        self.response = response
        self.positive = positive
        self.negative=negative
        self.neutral=neutral

# Define the Skills model
class Scores(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    communication_skills = db.Column(db.Float)
    creativity = db.Column(db.Float)
    problem_solving = db.Column(db.Float)
    reliability = db.Column(db.Float)
    team_work = db.Column(db.Float)
    time_management = db.Column(db.Float)
    willingness_to_learn = db.Column(db.Float)

    def __init__(self, communication_skills, creativity, problem_solving, reliability, team_work, time_management, willingness_to_learn):
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


with open("model.pickle","rb") as binary:
    model=pickle.load(binary)

def classify_sentiment(comment):
    arr=np.array([comment])
    probabilities = model.predict_proba(arr)[0]
    labels=['negative','positive','neutral']
    return dict(zip(labels,probabilities))

@app.route('/', methods=['GET','POST'])
def ask_question():
    return render_template('questionaire.html')

# Define the route for model prediction and saving to the database
@app.route('/predict', methods=['POST'])
def predict():
    
    opinion = request.form.get("opinion")
    scores={
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
    sentiments=classify_sentiment(opinion)
    sentiments={'response':opinion,**sentiments}
    # Save the response and sentiment to the database
    sentiment_entry = Sentiment(**sentiments)
    scores=Scores(**scores)
    db.session.add(sentiment_entry)
    db.session.add(scores)
    db.session.commit()
    # Return the response as JSON
    return jsonify({'sentiments':sentiments,"scores":scores})

@app.route('/report',methods=['GET'])
def report():
    return render_template('Candidate Reports.html')

@app.route('/candidateData/<candidateName>')
def getCandidateData(candidateName):
    imageName="profile-img.jpg"
    data:dict={
        candidateName:{
        'sentiments':{
            'positive':75,
            'negative':5,
            'neutral':20
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