import axios from "axios";
import React, { useEffect, useState } from "react";
import { Doughnut } from "react-chartjs-2";
import "../../../styles/statistiques.css";


/**
 * Statistique des proportions des clients
 * @param {*Taille du widget} props 
 * @returns un graphique
 */
const ProportionClients = (props) => {
  const [data, setData] = useState([]);
  const [nombres, setNombres] = useState([]);
  const [label, setLabel] = useState([]);
  const [color, setColor] = useState([]);
  const taille = props.taille;

  /**
   * Récupère les données pour les statistiques
   */
  useEffect(() => {
    axios
      .get("https://stage.hofmann.fr/sitereact/server/api/Statistiques.php", {
        params: {
          getNombreClients: 1,
        },
      })
      .then((res) => {
        setData(res.data);
      });
  }, []);

  /**
   * Initialise les labels et les couleurs pour chaque donnée récupérée
   */
  useEffect(() => {
    data.map(
      (element) => (
        setLabel((label) => [...label, element[1]]),
        setNombres((nombres) => [...nombres, element[0]]),
        setColor((color) => [
          ...color,
          "#" + Math.floor(Math.random() * 16777215).toString(16),
        ])
      )
    );
  }, [data]);

  return (
    <div className="nombreClients">
      <Doughnut
        data={{
          labels: label,
          datasets: [
            {
              backgroundColor: color,
              data: nombres,
            },
          ],
        }}
        options={{
          plugins: {
            title: {
              display: true,
              text: "Proportion des différents clients",
            },
          },
        }}
      />
    </div>
  );
};

export default ProportionClients;
