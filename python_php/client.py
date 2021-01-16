# lets make the client code
import sys
print(sys.version)
import socket,  pickle, struct
import numpy as np
import cv2
print(cv2.version)

c = 0
# create socket
client_socket = socket.socket(socket.AF_INET,socket.SOCK_STREAM)
host_ip = "0.tcp.ngrok.io" # paste your server ip address here
port = 15168
client_socket.connect((host_ip,port)) # a tuple
data = b""
payload_size = struct.calcsize("Q")
while True:
    while len(data) < payload_size:
        packet = client_socket.recv(41024) # 4K
        if not packet: break
        data+=packet
    packed_msg_size = data[:payload_size]
    data = data[payload_size:]
    msg_size = struct.unpack("Q",packed_msg_size)[0]
    c+=1

    while len(data) < msg_size:
        data += client_socket.recv(41024)

    frame_data = data[:msg_size]
    data  = data[msg_size:]
    if (c%2 == 0):
        frame = pickle.loads(frame_data)
    else:
        frame2 = pickle.loads(frame_data)
    if (c==1):
        frame = frame2
    framef = np.hstack((frame, frame2))
    cv2.imshow("RECEIVING VIDEO",framef)
    if cv2.waitKey(1)  == ord('q'):
        break
client_socket.close()
