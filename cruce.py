from __future__ import absolute_import
from __future__ import print_function

import os
import sys
import optparse
import random
import numpy       
import json
import psycopg2
from functools import reduce

# constantes globales para la conexon con database
PSQL_HOST = "ec2-52-5-176-53.compute-1.amazonaws.com"
PSQL_PORT = "5432"
PSQL_USER = "vsemigwrofvgsy"
PSQL_PASS = "dec78e50cb74ebc76535f8d151c84df463eeeaed42063d5eb51a0b2b36f81643"
PSQL_DB = "de220cmq22267r"

# Conexion
connection_address= """
host=%s port=%s user=%s password=%s dbname=%s
""" % (PSQL_HOST, PSQL_PORT, PSQL_USER, PSQL_PASS, PSQL_DB)
connection = psycopg2.connect(connection_address)

cursor = connection.cursor()

id_cruce=sys.argv[1]


### CODIGO DE ENTRENAMIENTO
def dec_a_base3(decimal):
    num_base3 = ''
    while decimal // 3 != 0:
        num_base3 = str(decimal % 3) + num_base3
        decimal = decimal // 3
    return str(decimal) + num_base3

def dec_a_base2(decimal):
    num_base2 = ''
    while decimal // 2 != 0:
        num_base2 = str(decimal % 2) + num_base2
        decimal = decimal // 2
    return str(decimal) + num_base2

state_m = numpy.array([[0,0,0,0,0,0,0,0]])
for i in range(1, 256):
   state_l= [int(x) for x in list('{0:0b}'.format(i))]
   state_a= numpy.array(state_l)
   if state_a.size < 8:
     for i in range(state_a.size,8):
       state_a = numpy.append([0], state_a)
   state_m = numpy.append(state_m, [state_a], axis=0)

action_m = numpy.array([[0,0,0,0]])
for i in range(1, 81):
   action_l = dec_a_base3(i)
   action_l = [int(x) for x in str(action_l)]
   action_a= numpy.array(action_l)
   if action_a.size < 4:
     for i in range(action_a.size,4):
       action_a = numpy.append([0], action_a)
   action_m = numpy.append(action_m, [action_a], axis=0)

matriz_P_estado_sig = numpy.zeros((256, 81))
matriz_P_recomp = numpy.zeros((256, 81))

for i in range(0, 256):
  for j in range(0, 81):
     recompensa= numpy.zeros(4)
     estado_sig_resp = numpy.zeros(8)
          
     for k in range(0, 4):
       if ((state_m[i,k] == 0) and (state_m[i,k+4] == 0) and (action_m[j,k] == 0)):
           # Si el TV es corto, la cola de carros es corta y la accion es mantener el TV es algo logico
           recompensa[k] = 5      
           estado_sig_resp[k] = 0
           estado_sig_resp[k+4] = 0
       if (state_m[i,k] == 0) and (state_m[i,k+4] == 0) and (action_m[j,k] == 1):
           # Si el TV es corto, la cola de carros es corta y la accion es disminuir el TV es algo ilogico, no se puede disminuir mas
           recompensa[k] = 0    
           estado_sig_resp[k] = 0
           estado_sig_resp[k+4] = 0
       if (state_m[i,k] == 0) and (state_m[i,k+4] == 0) and (action_m[j,k] == 2):
           # Si el TV es corto, la cola de carros es corta y la accion es aumentar el TV es algo ilogico, no se requeriria aumentar
           recompensa[k] = 0    
           estado_sig_resp[k] = 1
           estado_sig_resp[k+4] = 0
       
       if (state_m[i,k] == 0) and (state_m[i,k+4] == 1) and (action_m[j,k] == 0):
           # Si el TV es corto, la cola de carros es larga y la accion es mantener el TV es algo poco util
           recompensa[k] = 1    
           estado_sig_resp[k] = 0
           estado_sig_resp[k+4] = 1
       if (state_m[i,k] == 0) and (state_m[i,k+4] == 1) and (action_m[j,k] == 1):
           # Si el TV es corto, la cola de carros es larga y la accion es disminur el TV es algo ilogico, no se puede disminuir mas
           recompensa[k] = 1    
           estado_sig_resp[k] = 0
           estado_sig_resp[k+4] = 1
       if (state_m[i,k] == 0) and (state_m[i,k+4] == 1) and (action_m[j,k] == 2):
           # Si el TV es corto, la cola de carros es larga y la accion es aumentar el TV es algo logico y util.
           recompensa[k] = 10    
           estado_sig_resp[k] = 1
           estado_sig_resp[k+4] = 1

       if (state_m[i,k] == 1) and (state_m[i,k+4] == 0) and (action_m[j,k] == 0):
           # Si el TV es largo, la cola de carros es corta y la accion es mantener el TV es muy poco util
           recompensa[k] = 1    
           estado_sig_resp[k] = 1
           estado_sig_resp[k+4] = 0
       if (state_m[i,k] == 1) and (state_m[i,k+4] == 0) and (action_m[j,k] == 1):
           # Si el TV es largo, la cola de carros es corta  y la accion es disminur el TV es algo logico y puede ser util.
           recompensa[k] = 5    
           estado_sig_resp[k] = 0
           estado_sig_resp[k+4] = 0
       if (state_m[i,k] == 1) and (state_m[i,k+4] == 0) and (action_m[j,k] == 2):
           # Si el TV es largo, la cola de carros es corta y la accion es aumentar el TV es algo ilogico.
           recompensa[k] = 0    
           estado_sig_resp[k] = 1
           estado_sig_resp[k+4] = 0
           
       if (state_m[i,k] == 1) and (state_m[i,k+4] == 1) and (action_m[j,k] == 0):
           # Si el TV es largo, la cola de carros es larga y la accion es mantener el TV es muy logico
           recompensa[k] = 10    
           estado_sig_resp[k] = 1
           estado_sig_resp[k+4] = 1
       if (state_m[i,k] == 1) and (state_m[i,k+4] == 1) and (action_m[j,k] == 1):
           # Si el TV es largo, la cola de carros es larga y la accion es disminur el TV es algo ilogico.
           recompensa[k] = 0    
           estado_sig_resp[k] = 0
           estado_sig_resp[k+4] = 1
       if (state_m[i,k] == 1) and (state_m[i,k+4] == 1) and (action_m[j,k] == 2):
           # Si el TV es largo, la cola de carros es larga y la accion es aumentar el TV es algo ilogico no se puede aumentar mas.
           recompensa[k] = 0    
           estado_sig_resp[k] = 1
           estado_sig_resp[k+4] = 1
     
     recompensa_final = recompensa[0]+recompensa[1]+recompensa[2]+recompensa[3]
     matriz_P_recomp[i,j] = recompensa_final
     # Lo siguiente es para pasar de un arreglo binario a un valor entero
     estado_sig_valor = reduce(lambda a,b: 2*a+b, estado_sig_resp)
     matriz_P_estado_sig[i,j] =estado_sig_valor

# Hasta aqui se ha calculado la matriz P (recompensa), ahora se procede a llenar la matriz Q con valores de entrenamiento ("Training")

# Hyperparameters
alpha = 0.6
gamma = 0.4
epsilon = 0.9
matriz_Q = numpy.zeros((256, 81))
for i in range(0, 300):
  state = random.randint(0, 255)
  epochs = 0
  while (epochs < 1200):
         # algunas veces action sera la posicion en donde esta el valor maximo de la matriz Q en la fila con el numero de estado
         # otra vez sera un valor aleatorio, la decision que se toma para asignar accion, dependera del valor epsilon
         if random.uniform(0, 1) < epsilon:
            action = random.randint(0, 80)
         else:
            action = numpy.argmax(matriz_Q[state])

         reward = matriz_P_recomp[state,action]
         next_state = matriz_P_estado_sig[state,action]
         next_state = int(next_state)
         old_value =  matriz_Q[state,action]
         # se debe hallar el maximo de la tabla q en el estado next state.
         next_max = numpy.amax(matriz_Q[next_state], axis=0)
         new_value = (1 - alpha) * old_value + alpha * (reward + gamma * next_max)
         matriz_Q[state, action] = new_value
         state = next_state
         epochs = epochs + 1

### FIN DEL CODIGO DE ENTRENAMIENTO

### FUNCION DE RECOMENDACION
def recomendacion_estado_siguiente(state):
    # print("<h3> SISTEMA DE RECOMENDACION </h3>")
    action = numpy.argmax(matriz_Q[state])
    recomendacion = dec_a_base3(action)
    # print("<br> Estado actual: ", state)
    # print("<br> Estado siguie: ", action)
    return recomendacion
### FIN FUNCION DE RECOMENDACION

### Conversor accion a semaforo
def conversor_tiempos(matriz_Q,matriz_P):
    siguiente=[]
    semaforo = ""
    matriz_P=[int(i) for i in matriz_P]

    # print("<br> q:",matriz_Q)
    # print("<br> a:",matriz_P)
    for i in range (0,4):
        if (matriz_Q[i] ==0 and matriz_P[i]==0): 
            siguiente.append(0)
        if (matriz_Q[i] ==1 and matriz_P[i]==0): 
            siguiente.append(1)

        if (matriz_Q[i] ==0 and matriz_P[i]==1): 
            siguiente.append(0)
        if (matriz_Q[i] ==1 and matriz_P[i]==1): 
            siguiente.append(0)

        if (matriz_Q[i] ==0 and matriz_P[i]==2): 
            siguiente.append(1)
        if (matriz_Q[i] ==1 and matriz_P[i]==2): 
            siguiente.append(1)

    # print("<br> Siguiente estado:",siguiente)
    print("<table width='35%'  align=center cellpadding=5 border=1 bgcolor='#2E4053'>")
    print("<tr><td bgcolor='#F4B120' align=center> EastWest ")
    print("</td>")
    print("<td bgcolor='#F4B120' align=center> SouthNort ")
    print("</td>")
    print("<td bgcolor='#F4B120' align=center> WestEast ")
    print("</td>")
    print("<td bgcolor='#F4B120' align=center> NortSouth ")
    print("</td></tr>")
    for i in range (0,4):
        if siguiente[i]==0:
            print("<td bgcolor='#EEEEEE' align=center> ShortTime </td>")
            semaforo=semaforo+"ST"
        if siguiente[i]==1:
            print("<td bgcolor='#EEEEEE' align=center> LongTime </td>")
            semaforo=semaforo+"LT"
    
    print("</table>")
    return semaforo,siguiente
### Fin conversor accion a semaforo

### INICIO CODIGO PARA RECOMENDACION
estado_actual = [0,0,0,0,0,0,0,0]

sql2 = "select plan from cruce where id='"+id_cruce+"';"
cursor.execute(sql2)
rows = cursor.fetchall()
for row in rows:
    plan = row[0]

print("<center> <h3>Tiempo semaforos actual</h3>")
print("<table width='35%'  align=center cellpadding=5 border=1 bgcolor='#2E4053'>")
print("<tr><td bgcolor='#F4B120' align=center> EastWest")
print("</td>")
print("<td bgcolor='#F4B120' align=center> SouthNort")
print("</td>")
print("<td bgcolor='#F4B120' align=center> WestEast")
print("</td>")
print("<td bgcolor='#F4B120' align=center> NortSouth")
print("</td></tr><tr>")

if(plan[0:2]=="ST"):
    estado_actual[0] = 0
    print("<td bgcolor='#EEEEEE' align=center> ShortTime")
    print("</td>")

else:
    estado_actual[0] = 1
    print("<td bgcolor='#EEEEEE' align=center> LongTime")
    print("</td>")

if(plan[2:4]=="ST"):
    estado_actual[1] = 0
    print("<td bgcolor='#EEEEEE' align=center> ShortTime")
    print("</td>")

else:
    estado_actual[1] = 1
    print("<td bgcolor='#EEEEEE' align=center> LongTime")
    print("</td>")

if(plan[4:6]=="ST"):
    estado_actual[2] = 0
    print("<td bgcolor='#EEEEEE' align=center> ShortTime")
    print("</td>")

else:
    estado_actual[2] = 1
    print("<td bgcolor='#EEEEEE' align=center> LongTime")
    print("</td>")

if(plan[6:8]=="ST"):
    estado_actual[3] = 0
    print("<td bgcolor='#EEEEEE' align=center> ShortTime")
    print("</td>")

else:
    estado_actual[3] = 1
    print("<td bgcolor='#EEEEEE' align=center> LongTime")
    print("</td>")

print("</tr></table>")

# ESTE ES EL ORDEN DE PRIORIDAD DEL SEMAFORO, PRIMERO PASA A VERDE EW, LUEGO SN, LUEGO WE Y FINALMENTE NS
sql1 = "SELECT * FROM colas_reales where id_cruce='"+id_cruce+"';"
cursor.execute(sql1)
colas = cursor.fetchall()
for cola in colas:
    print("<br> <h3> Colas obtenidas </h3>")

queuEW = cola[2]
queuSN = cola[3]
queuWE = cola[4]
queuNS = cola[5]
print("<table width='35%'  align=center cellpadding=5 border=1 bgcolor='#2E4053'>")
print("<tr><td bgcolor='#EEEEEE' align=center> EastWest: ", queuEW)
print("</td>")
print("<td bgcolor='#EEEEEE' align=center> SouthNort: ", queuSN)
print("</td>")
print("<td bgcolor='#EEEEEE' align=center> WestEast: ", queuWE)
print("</td>")
print("<td bgcolor='#EEEEEE' align=center> NortSouth: ", queuNS)
print("</td></tr> </table>")

sql = "SELECT ew, sn, we, ns FROM cruce where id='"+id_cruce+"';"
cursor.execute(sql)
parametros = cursor.fetchall()
for parametro in parametros:
    print("<br>")
        
if queuEW > parametro[0]:
    estado_actual[4]=1
else:    
    estado_actual[4]=0
if queuSN > parametro[1]:
    estado_actual[5]=1
else:
    estado_actual[5]=0    
if queuWE > parametro[2]:
    estado_actual[6]=1
else:    
    estado_actual[6]=0
if queuNS > parametro[3]:
    estado_actual[7]=1
else:
    estado_actual[7]=0

estado_bin=str(estado_actual[0])+str(estado_actual[1])+str(estado_actual[2])+str(estado_actual[3])+str(estado_actual[4])+str(estado_actual[5])+str(estado_actual[6])+str(estado_actual[7])
#estado_bin="10101010"
estado_dec=int(estado_bin, base=2)
estado_st=recomendacion_estado_siguiente(estado_dec)
estado_st=list(str(estado_st))
if (len(estado_st)==1):
    estado_st.insert(0,0)
    estado_st.insert(0,0)
    estado_st.insert(0,0)
if (len(estado_st)==2):
    estado_st.insert(0,0)
    estado_st.insert(0,0)
if (len(estado_st)==3):
    estado_st.insert(0,0)

print("<br> <h3> Nuevo Tiempo Semaforos: </h3></center>")
nuevo_tiempo, nuevo_estado=conversor_tiempos(estado_actual,estado_st)

for i in range(0,4):
    estado_actual[i]=nuevo_estado[i]

### PRUEBA PARA ACTUALIZAR PLAN EN BD
print("<br><center><h3>Desea actualizar el plan de semaforos</h3><form method=POST action='tabla_recomendacion.php'><table border=0 width='50%' align=center>")
print("<input type='hidden' name=plan value='"+nuevo_tiempo+"' readonly='readonly' required>")
print("</table><input type='hidden' value='S' name='enviado'><input type='hidden' value='"+id_cruce+"' name='id_cruce'> <input type=submit value='Actualizar' name='Modificar'></center>")

### FIN PRUEBA

cursor.close()
connection.close()
sys.stdout.flush()
### FIN CODIGO PARA RECOMENDACION
