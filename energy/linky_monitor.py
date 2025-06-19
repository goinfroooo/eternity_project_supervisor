#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import serial
import time
from datetime import datetime

# Configuration du port série
# Le port peut varier selon votre configuration
SERIAL_PORT = '/dev/ttyUSB0'  # ou '/dev/ttyAMA0' selon votre configuration
BAUD_RATE = 1200
BYTE_SIZE = serial.SEVENBITS
PARITY = serial.PARITY_EVEN
STOP_BITS = serial.STOPBITS_ONE

def init_serial():
    """Initialise la connexion série avec le compteur Linky"""
    try:
        ser = serial.Serial(
            port=SERIAL_PORT,
            baudrate=BAUD_RATE,
            bytesize=BYTE_SIZE,
            parity=PARITY,
            stopbits=STOP_BITS,
            timeout=1
        )
        return ser
    except serial.SerialException as e:
        print(f"Erreur lors de l'ouverture du port série : {e}")
        return None

def read_linky_data(ser):
    """Lit les données du compteur Linky"""
    if ser is None:
        return
    
    try:
        while True:
            if ser.in_waiting:
                line = ser.readline().decode('ascii', errors='ignore').strip()
                if line.startswith('BASE'):  # Puissance instantanée
                    print(f"\n[{datetime.now().strftime('%H:%M:%S')}] Puissance instantanée : {line.split()[1]} W")
                elif line.startswith('HCHC'):  # Index heures creuses
                    print(f"[{datetime.now().strftime('%H:%M:%S')}] Index heures creuses : {line.split()[1]} Wh")
                elif line.startswith('HCHP'):  # Index heures pleines
                    print(f"[{datetime.now().strftime('%H:%M:%S')}] Index heures pleines : {line.split()[1]} Wh")
                elif line.startswith('IINST'):  # Intensité instantanée
                    print(f"[{datetime.now().strftime('%H:%M:%S')}] Intensité instantanée : {line.split()[1]} A")
            
            time.sleep(0.1)  # Petit délai pour ne pas surcharger le CPU
            
    except KeyboardInterrupt:
        print("\nArrêt du programme...")
    except Exception as e:
        print(f"Erreur lors de la lecture : {e}")
    finally:
        if ser:
            ser.close()

def main():
    print("Démarrage du programme de lecture du compteur Linky...")
    print("Appuyez sur Ctrl+C pour arrêter")
    
    ser = init_serial()
    if ser:
        read_linky_data(ser)

if __name__ == "__main__":
    main() 