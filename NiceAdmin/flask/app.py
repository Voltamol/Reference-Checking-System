from flask import Flask, request, jsonify,render_template
from flask_sqlalchemy import SQLAlchemy
import pickle
import numpy as np
from urllib.parse import quote_plus

# Create a Flask app
app = Flask(__name__)

app.config['SQLALCHEMY_DATABASE_URI'] = f"mysql://root:@localhost/ref_sys"
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