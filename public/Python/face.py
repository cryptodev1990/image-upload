import cv2
from detector import FaceDetect
import argparse

if __name__ == "__main__":
    parser = argparse.ArgumentParser()
    parser.add_argument('--img_path', type=str, default='', help='input image path')
    opt = parser.parse_args()
    detector = FaceDetect()
    box = detector.detect(opt.img_path)
    width = box.xmax-box.xmin
    height = box.ymax-box.ymin
    print(box.xmin, box.ymin, width, height)