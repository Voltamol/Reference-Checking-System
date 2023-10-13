from flask import Flask, request, jsonify,render_template
from flask_sqlalchemy import SQLAlchemy
import tensorflow as tf
from tensorflow.keras.preprocessing.text import Tokenizer
from tensorflow.keras.preprocessing.sequence import pad_sequences
import numpy as np
import pickle
# Create a Flask app
app = Flask(__name__)

# Configure the SQLAlchemy database
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

# Create the database tables
with app.app_context():
    db.create_all()

# Load the TensorFlow model for sentiment analysis
with open("sentimentmodel.pkl","rb") as binary:
    model=pickle.load(binary)

# Load the TensorFlow model for sentiment analysis
#model = tf.keras.models.load_model('comment_classifier_model.h5')

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

@app.route('/', methods=['GET','POST'])
def ask_question():
    return render_template('questionaire.html')

# Define the route for model prediction and saving to the database
@app.route('/predict', methods=['POST'])
def predict():
    
    opinion = request.form.get("opinion")
    
    # Preprocess the input data (if required)
    # ...

    # Perform prediction using the loaded model
    sentiments=classify_sentiment(opinion)
    sentiments={'response':opinion,**sentiments}
    # Save the response and sentiment to the database
    sentiment_entry = Sentiment(**sentiments)
    db.session.add(sentiment_entry)
    db.session.commit()
    # Return the response as JSON
    return jsonify({'sentiments':sentiments})

# Define the main entry point of the application
if __name__ == '__main__':
    # Run the Flask app
    app.run(debug=True)