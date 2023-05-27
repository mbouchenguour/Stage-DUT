import axios from "axios";
import React, { useEffect, useState } from "react";
import { Bar } from "react-chartjs-2";
import "../../../styles/statistiques.css";

/**
 * Statistique des proportions des nouveaux clients
 * @returns un graphique
 */
const ProportionServices = () => {
  const [data, setData] = useState([]);
  const [nombres, setNombres] = useState([]);
  const [label, setLabel] = useState([]);
  const [color, setColor] = useState([]);

  /**
   * Récupère les données pour les statistiques
   */
  useEffect(() => {
    axios
      .get("https://stage.hofmann.fr/sitereact/server/api/Statistiques.php", {
        params: {
          getNombreClientParService: 1,
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
    <div className="nombreClientsParService">
      <Bar
        data={{
          labels: label,
          datasets: [
            {
              label: "Services",
              backgroundColor: color,
              data: nombres,
            },
          ],
        }}
        option={{
          plugins: {
            title: {
              display: true,
              text: "Proportion des différents services en cours",
            },
          },
        }}
      />
    </div>
  );
};

export default ProportionServices;
