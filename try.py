import pickle

# Assuming you have a trained model named 'model_building'
# ... your code to train the model ...

# Save the model as a pickle file
with open('sentiment_model.pkl', 'wb') as file:
    pickle.dump(model building, file)