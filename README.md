# Lecteur de Compteur Linky

Ce script permet de lire les données en temps réel d'un compteur Linky via un Raspberry Pi.

## Prérequis

- Raspberry Pi (testé sur Raspberry Pi 3 et 4)
- Câble TIC vers USB ou GPIO
- Python 3.x
- Bibliothèque pyserial

## Installation

1. Installez les dépendances Python :
```bash
pip3 install pyserial
```

2. Connectez le câble TIC à votre Raspberry Pi :
   - Si vous utilisez un adaptateur USB : connectez-le à un port USB
   - Si vous utilisez un câble GPIO : connectez-le aux pins GPIO appropriés

3. Vérifiez le port série utilisé :
```bash
ls /dev/tty*
```
Le port sera probablement `/dev/ttyUSB0` pour un adaptateur USB ou `/dev/ttyAMA0` pour une connexion GPIO.

4. Modifiez la variable `SERIAL_PORT` dans le script si nécessaire.

## Utilisation

1. Exécutez le script :
```bash
python3 linky_monitor.py
```

2. Les données suivantes seront affichées en temps réel :
   - Puissance instantanée (W)
   - Index heures creuses (Wh)
   - Index heures pleines (Wh)
   - Intensité instantanée (A)

3. Pour arrêter le programme, appuyez sur Ctrl+C.

## Dépannage

- Si vous obtenez une erreur d'accès au port série, assurez-vous que votre utilisateur fait partie du groupe `dialout` :
```bash
sudo usermod -a -G dialout $USER
```
Puis redémarrez votre session.

- Si aucune donnée n'apparaît, vérifiez :
  - La connexion du câble
  - Le port série utilisé
  - Les paramètres de communication (baudrate, parité, etc.) 