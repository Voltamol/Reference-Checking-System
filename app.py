from flask import Flask, request, jsonify, render_template
from flask_sqlalchemy import SQLAlchemy
import pickle

app = Flask(__name__)
# app.config['SQLALCHEMY_DATABASE_URI'] = 'postgresql://username:password@localhost/mydatabase'
# db = SQLAlchemy(app)

# # Define a model for storing sentiment analysis results in the database
# class SentimentResult(db.Model):
#     id = db.Column(db.Integer, primary_key=True)
#     text = db.Column(db.String(255))
#     sentiment = db.Column(db.String(10))

# Load the sentiment analysis model
#with open('sentiment_model.pkl', 'rb') as f:
#    model = pickle.load(f)

@app.route('/', methods=['GET'])
def index():
    return render_template('new.html')

# @app.route('/sentiment-analysis', methods=['POST'])
# def analyze_sentiment():
#     text = request.form['text']

    # Perform sentiment analysis using the loaded model
    #sentiment = model.predict(text)

    # Create a new SentimentResult object
    # result = SentimentResult(text=text, sentiment=sentiment)

    # # Add the result to the database
    # db.session.add(result)
    # db.session.commit()

    #return jsonify({'sentiment': sentiment})

if __name__ == '__main__':
    app.run()