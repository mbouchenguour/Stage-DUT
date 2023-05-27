import axios from "axios";
import React, { useState, useEffect } from "react";
import { Bar, Doughnut } from "react-chartjs-2";
import "../../../styles/statistiques.css";

/**
 * Statistique des proportions des nouveaux clients
 * @returns Un graphique
 */
const ProportionNouveauClient = () => {
  const [annee, setAnnee] = useState(2021);

  const [evolutionPar, setEvolutionPar] = useState([]);
  const [evolutionPro, setEvolutionPro] = useState([]);
  const [evolutionAss, setEvolutionAss] = useState([]);

  const [color, setColor] = useState([]);
  const labels = [
    "Janvier",
    "Février",
    "Mars",
    "Avril",
    "Mai",
    "Juin",
    "Juillet",
    "Août",
    "Septembre",
    "Octobre",
    "Novembre",
    "Décembre",
  ];

  /**
   * Initialise les couleurs
   */
  useEffect(() => {
    for (let i = 0; i < 3; i++) {
      setColor((color) => [
        ...color,
        "#" + Math.floor(Math.random() * 16777215).toString(16),
      ]);
    }
  }, []);

  /**
   * Récupère les données pour les statistiques
   */
  useEffect(() => {
    axios
      .get("https://stage.hofmann.fr/sitereact/server/api/Statistiques.php", {
        params: {
          year: annee,
        },
      })
      .then((res) => {
        setEvolutionPar(res.data[0]);
        setEvolutionPro(res.data[1]);
        setEvolutionAss(res.data[2]);
      });
  }, [annee]);

  return (
    <div className="nombreNouveauClients">
      <input
        type="number"
        value={annee}
        onChange={(event) => setAnnee(event.target.value)}
      />

      <Bar
        data={{
          labels: labels,
          datasets: [
            {
              stack: "stack",
              label: "Particulier",
              data: evolutionPar,
              backgroundColor: color[0],
            },
            {
              stack: "stack",
              label: "Professionnel",
              data: evolutionPro,
              backgroundColor: color[1],
            },
            {
              stack: "stack",
              label: "Association",
              data: evolutionAss,
              backgroundColor: color[2],
            },
          ],
        }}
        option={{
          plugins: {
            title: {
              display: true,
              text: "Evolution nombre des salariés en " + annee,
            },
          },
          responsive: true,
          scales: {
            x: {
              stacked: true,
            },
            y: {
              stacked: true,
            },
          },
        }}
      />
    </div>
  );
};

export default ProportionNouveauClient;
