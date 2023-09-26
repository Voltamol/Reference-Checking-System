from flask import Flask, request, jsonify,render_template
from flask_sqlalchemy import SQLAlchemy
import tensorflow as tf

# Create a Flask app
app = Flask(__name__)

# Configure the SQLAlchemy database
app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///sentiments.db'
db = SQLAlchemy(app)

# Define the Sentiment model for the database
class Sentiment(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    response = db.Column(db.String(500))
    sentiment = db.Column(db.String(10))

    def __init__(self, response, sentiment):
        self.response = response
        self.sentiment = sentiment

# Create the database tables
with app.app_context():
    db.create_all()

# Load the TensorFlow model for sentiment analysis
#model = tf.keras.models.load_model('models/comment_classifier_model.h5')

@app.route('/', methods=['GET','POST'])
def ask_question():
    return render_template('questionaire.html')

# Define the route for model prediction and saving to the database
@app.route('/predict', methods=['POST'])
def predict():
    
    response = request.form.get("opinion")
    #print(response)
    return jsonify({'response':response})
    # Preprocess the input data (if required)
    # ...

    # Perform prediction using the loaded model
    prediction = model.predict(data)
    sentiment = 'positive' if prediction > 0.5 else 'negative'

    # Postprocess the prediction (if required)
    # ...

    # Save the response and sentiment to the database
    sentiment_entry = Sentiment(response=response, sentiment=sentiment)
    db.session.add(sentiment_entry)
    db.session.commit()

    # Create a response dictionary
    response = {'prediction': sentiment}

    # Return the response as JSON
    return jsonify(response)

# Define the main entry point of the application
if __name__ == '__main__':
    # Run the Flask app
    app.run(debug=True)