from sklearn.datasets import load_iris
from sklearn.model_selection import cross_val_score, KFold, ShuffleSplit, RepeatedKFold, LeaveOneOut
from sklearn.svm import SVC
import numpy as np

# Load Iris dataset
iris = load_iris()
X, y = iris.data, iris.target

# Define SVM classifier
svm_classifier = SVC(kernel='linear')

# Define the number of folds for cross-validation
num_folds = 5

# K-Fold Cross-Validation
kfold_scores = cross_val_score(svm_classifier, X, y, cv=KFold(n_splits=num_folds))
print("K-Fold Cross-Validation Scores:", kfold_scores)
print("Mean Accuracy (K-Fold):", np.mean(kfold_scores))

# Shuffled K-Fold Cross-Validation
shuffled_kfold_scores = cross_val_score(svm_classifier, X, y, cv=ShuffleSplit(n_splits=num_folds, test_size=0.2))
print("Shuffled K-Fold Cross-Validation Scores:", shuffled_kfold_scores)
print("Mean Accuracy (Shuffled K-Fold):", np.mean(shuffled_kfold_scores))

# Repeated K-Fold Cross-Validation
num_repeats = 3
repeated_kfold_scores = cross_val_score(svm_classifier, X, y, cv=RepeatedKFold(n_splits=num_folds, n_repeats=num_repeats))
print("\n\nRepeated K-Fold Cross-Validation Scores:", repeated_kfold_scores)
print("Mean Accuracy (Repeated K-Fold):", np.mean(repeated_kfold_scores))

# Leave-One-Out Cross-Validation
leave_one_out_scores = cross_val_score(svm_classifier, X, y, cv=LeaveOneOut())
print("Leave-One-Out Cross-Validation Scores:", leave_one_out_scores)
print("Mean Accuracy (Leave-One-Out):", np.mean(leave_one_out_scores))
