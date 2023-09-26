from flask import Flask, request, jsonify,render_template
from flask_sqlalchemy import SQLAlchemy
import tensorflow as tf
from tensorflow.keras.preprocessing.text import Tokenizer
from tensorflow.keras.preprocessing.sequence import pad_sequences

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
model = tf.keras.models.load_model('models/comment_classifier_model.h5')

def preprocess_input(user_input):
    #-----------------------------------------------------------
    max_words = 10000
    max_len = 100
    comments=user_input
    #-----------------------------------------------------------
    tokenizer = Tokenizer(num_words=max_words)
    tokenizer.fit_on_texts(comments)
    sequences = tokenizer.texts_to_sequences(comments)
    padded_sequences = pad_sequences(sequences, maxlen=max_len)
    #-----------------------------------------------------------
    return padded_sequences

@app.route('/', methods=['GET','POST'])
def ask_question():
    return render_template('questionaire.html')

# Define the route for model prediction and saving to the database
@app.route('/predict', methods=['POST'])
def predict():
    
    response = request.form.get("opinion")
    
    # Preprocess the input data (if required)
    # ...

    # Perform prediction using the loaded model
    data=preprocess_input(response)
    sentiment = model.predict(data)
    
    print('sentiment:',sentiment)
    return jsonify({'status':'done'})
    # Postprocess the prediction (if required)
    # ...

    # Save the response and sentiment to the database
    sentiment_entry = Sentiment(response=response, sentiment=sentiment)
    db.session.add(sentiment_entry)
    db.session.commit()

    # Create a response dictionary
    response = {'response':response,'prediction': sentiment}

    # Return the response as JSON
    return jsonify(response)

# Define the main entry point of the application
if __name__ == '__main__':
    # Run the Flask app
    app.run(debug=True)