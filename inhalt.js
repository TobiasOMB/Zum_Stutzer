/* =====================================================================
   INHALT DER WEBSEITE  –  HIER KÖNNEN TEXTE, PREISE UND BILDER GEÄNDERT WERDEN
   ---------------------------------------------------------------------
   So geht's:
   • Nur den Text zwischen den "Anführungszeichen" ändern.
   • Anführungszeichen, Kommas und Klammern { } [ ] NICHT löschen.
   • Neue Zeile (z. B. neue Leistung) = eine bestehende Zeile kopieren und ändern.
   • Bilder: Foto in den Ordner "images" legen und hier den Dateinamen eintragen
     (oder ein Foto mit gleichem Namen überschreiben). Format: Hochformat/Querformat
     egal, besser Querformat ab 1920x1080 px für den Slider, max. 300 KB (JPG).
   • Preise: nur die Zahl ändern (Komma als Punkt schreiben, z. B. 22.5).
   • "min" = Dauer in Minuten (wichtig für die Terminbuchung, Sven arbeitet allein).
   ===================================================================== */
const INHALT = {

  salon:   { name: "Zum Stutzer", inhaber: "Sven Ritzenthaler" },
  kontakt: { strasse: "Kirchstraße 7", plz: "79258", ort: "Hartheim am Rhein", telefon: "0000 000000", email: "info@example.de" },
  rechtliches: { ustid: "DE000000000 (falls vorhanden)", kammer: "Handwerkskammer Freiburg" },

  oeffnungszeiten: [
    ["Montag", "Ruhetag"],
    ["Dienstag – Samstag", "8:00 – 12:00 und 13:30 – 18:00"],
    ["Sonntag", "geschlossen"]
  ],
  oeffnungKurz: "Di–Sa 8–12 & 13:30–18 Uhr · Montag Ruhetag",

  /* ---- GROSSER BILD-SLIDER GANZ OBEN (beliebig viele Einträge) ---- */
  slider: [
    /* "fokus" = welcher Bildteil bei Beschnitt sichtbar bleibt (links/rechts % und oben/unten %), z. B. "50% 50%" = Mitte */
    { bild: "images/slide-1.jpg", fokus: "45% 50%", titel: "Zum Stutzer",    text: "Friseur Sven Ritzenthaler · Hartheim am Rhein",             knopf: "Termin buchen",  link: "termin.html" },
    { bild: "images/slide-2.jpg", fokus: "60% 50%", titel: "Herrenschnitt",  text: "Klassisch, modern, auf den Punkt.",                         knopf: "Preise ansehen", link: "#leistungen" },
    { bild: "images/slide-3.jpg", fokus: "35% 50%", titel: "Damenfrisuren",  text: "Frische Spitzen, Locken und neue Looks.",                   knopf: "Preise ansehen", link: "#leistungen" },
    { bild: "images/slide-4.jpg", fokus: "42% 55%", titel: "Saubere Konturen", text: "Präzise Maschinenarbeit für Kurzhaarschnitte und Bärte.",   knopf: "Termin buchen",  link: "termin.html" },
    { bild: "images/slide-5.jpg", fokus: "55% 40%", titel: "Handwerk mit Liebe zum Detail", text: "Persönliche Beratung, ruhige Hand, volle Aufmerksamkeit.", knopf: "Kontakt", link: "#kontakt" }
  ],

  ueber: {
    ueberzeile: "Über uns",
    titel: "Sven Ritzenthaler & sein Salon",
    text: "Im „Zum Stutzer“ in der Kirchstraße 7 steht Sven Ritzenthaler selbst am Stuhl, und das ganz allein. Das bedeutet für dich: volle Aufmerksamkeit, ehrliche Beratung und genau die Zeit, die dein Haar braucht. Von außen charmant, von innen modern."
  },
  vorteile: [
    { symbol: "✦", titel: "Persönliche Beratung", text: "Wir hören zu, bevor die Schere angesetzt wird." },
    { symbol: "♡", titel: "Familienfreundlich",   text: "Vom Kinderschnitt bis zum Klassiker. Bei uns sind alle willkommen." },
    { symbol: "◈", titel: "Modernes Ambiente",    text: "Ein heller, zeitgemäßer Salon zum Entspannen." }
  ],

  /* ---- LEISTUNGEN & PREISE (auch für die Terminbuchung) ---- */
  leistungen: {
    ueberzeile: "Leistungen & Preise",
    titel: "Unser Angebot",
    hinweis: "Alle Preise inkl. MwSt. (Beispielpreise). Leistungen lassen sich bei der Buchung kombinieren.",
    gruppen: [
      { titel: "Herren", preise: [
        { name: "Herrenschnitt",    preis: 22, min: 30 },
        { name: "Maschinenschnitt", preis: 15, min: 20 },
        { name: "Bart trimmen",     preis: 10, min: 15 } ] },
      { titel: "Damen", preise: [
        { name: "Spitzen schneiden", preis: 25, min: 30 },
        { name: "Damenschnitt",      preis: 38, min: 45 } ] },
      { titel: "Kinder", preise: [
        { name: "Kinderschnitt (bis 12 J.)", preis: 14, min: 20 } ] },
      { titel: "Extras", preise: [
        { name: "Haare waschen",   preis: 6,  min: 10 },
        { name: "Föhnen / Styling", preis: 12, min: 15 },
        { name: "Tönen",           preis: 28, min: 30 } ] }
    ]
  },

  /* ---- BILDER-GALERIE ---- */
  galerie: {
    ueberzeile: "Eindrücke", titel: "Schnitte, die bleiben",
    bilder: [
      { bild: "images/schnitt-1.jpg", titel: "Herrenschnitt" },
      { bild: "images/schnitt-2.jpg", titel: "Damenschnitt" },
      { bild: "images/schnitt-3.jpg", titel: "Kinderschnitt" },
      { bild: "images/schnitt-4.jpg", titel: "Bart & Konturen" },
      { bild: "images/schnitt-5.jpg", titel: "Föhnen & Styling" },
      { bild: "images/schnitt-6.jpg", titel: "Der Salon" }
    ]
  },

  bewertungen: { ueberzeile: "Bewertungen", titel: "Das sagen unsere Kunden" },
  kontaktText: { ueberzeile: "Kontakt", titel: "Besuch uns" }
};
