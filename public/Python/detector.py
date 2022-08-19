"""
    Face Detection Module based on Yolov5
    2022.7.24
    @vectorgeek
"""
from os.path import exists
from matplotlib.pyplot import box
import torch

class FaceDetect:
    """
        Face Detection Class based on Yolov5
    """
    def __init__(self, model_path='Python/face.pt'):
        if not exists(model_path):
            print("Can not find the model.")
            return None
        self.model = torch.hub.load('ultralytics/yolov5', 'custom', path=model_path)
        self.initialized = True
    
    def detect(self, image_path):
        """
            Detect Face from specified image.
            @param image_path: image containing (or not) Face.
            @return box: box coordinates (xmin, ymin, xmax, ymax) if detected, None otherwise
        """

        if not self.initialized:
            print("Model is not initialized.")
            return None
        if not exists(image_path):
            print("Can not find the image.")
            return None
        
        detect_results = self.model(image_path)
        sorted_by_confidence_results = detect_results.pandas().xyxy[0].sort_values(by=['confidence'], ascending=False)
        if len(sorted_by_confidence_results) == 0:
            print("No Face detected")
            return None
        most_confident_box = sorted_by_confidence_results.iloc[0]
        
        return most_confident_box