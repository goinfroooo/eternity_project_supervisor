#include <Servo.h>

// Définition des broches pour chaque servo-moteur
#define PIN_BASE      2
#define PIN_EPAULE    3
#define PIN_COUDE     4
#define PIN_POIGNET   5
#define PIN_PINCE     6

// Création des objets Servo
Servo servoBase;
Servo servoEpaule;
Servo servoCoude;
Servo servoPoignet;
Servo servoPince;

// Positions initiales des servos (en degrés)
int posBase = 90;
int posEpaule = 90;
int posCoude = 90;
int posPoignet = 90;
int posPince = 90;

void setup() {
    Serial.begin(115200);
    // Attacher les servos aux broches correspondantes
    servoBase.attach(PIN_BASE);
    servoEpaule.attach(PIN_EPAULE);
    servoCoude.attach(PIN_COUDE);
    servoPoignet.attach(PIN_POIGNET);
    servoPince.attach(PIN_PINCE);

    // Placer les servos en position initiale
    servoBase.write(posBase);
    servoEpaule.write(posEpaule);
    servoCoude.write(posCoude);
    servoPoignet.write(posPoignet);
    servoPince.write(posPince);

    Serial.println("Bras robot prêt à être commandé.");
    Serial.println("Envoyez des commandes au format : B90 E120 C100 P80 M30");
    Serial.println("B=Base, E=Epaule, C=Coude, P=Poignet, M=Pince");
}

void loop() {
    if (Serial.available()) {
        String commande = Serial.readStringUntil('\n');
        commande.trim();

        // Recherche et mise à jour des positions selon la commande reçue
        int idx;
        if ((idx = commande.indexOf('B')) != -1) {
            posBase = commande.substring(idx+1).toInt();
            servoBase.write(posBase);
        }
        if ((idx = commande.indexOf('E')) != -1) {
            posEpaule = commande.substring(idx+1).toInt();
            servoEpaule.write(posEpaule);
        }
        if ((idx = commande.indexOf('C')) != -1) {
            posCoude = commande.substring(idx+1).toInt();
            servoCoude.write(posCoude);
        }
        if ((idx = commande.indexOf('P')) != -1) {
            posPoignet = commande.substring(idx+1).toInt();
            servoPoignet.write(posPoignet);
        }
        if ((idx = commande.indexOf('M')) != -1) {
            posPince = commande.substring(idx+1).toInt();
            servoPince.write(posPince);
        }

        // Affichage des positions actuelles
        Serial.print("Base: "); Serial.print(posBase);
        Serial.print(" | Epaule: "); Serial.print(posEpaule);
        Serial.print(" | Coude: "); Serial.print(posCoude);
        Serial.print(" | Poignet: "); Serial.print(posPoignet);
        Serial.print(" | Pince: "); Serial.println(posPince);
    }
}
