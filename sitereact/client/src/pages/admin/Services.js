import React, { useState, useEffect } from "react";
import axios from "axios";
import "../../styles/tableau.css";
import Service from "../../components/admin/Service";

/**
 * Permet d'afficher les services
 * @returns Un tableau contenant les services
 */
const Services = () => {
  const [services, setServices] = useState([]);
  const [activeMofif, setActiveModif] = useState(false);
  const [listeServicesModif, setListeServicesModif] = useState([]);

  /**
   * Récupére dans la bdd les différents services
   */
  useEffect(() => {
    axios
      .get("https://stage.hofmann.fr/sitereact/server/api/Services.php")
      .then((res) => {
        setServices(res.data);
      });
  }, []);

  /**
   * Effectue dans la bdd les modifications des services
   */
  const modifierServices = () => {
    setActiveModif(false);
    listeServicesModif.map((service) => {
      axios.put("https://stage.hofmann.fr/sitereact/server/api/Services.php", {
        data: service,
      });
    });
    setListeServicesModif([]);
  };

  /**
   * Annule les modifcations
   */
  const annulerServices = () => {
    setListeServicesModif([]);
    setActiveModif(false);
    axios
      .get("https://stage.hofmann.fr/sitereact/server/api/Services.php")
      .then((res) => {
        setServices(res.data);
      });
  };

  /**
   * Un tableau contenant les services
   */
  return (
    <div className="clientsPage">
      <div className="clients">
        <table className="tableau">
          <thead>
            <tr>
              <th>Identifiant</th>
              <th>Nom du service</th>
              <th>Description</th>
              <th>Origine</th>
              <th>Taux de TVA</th>
              <th>Prix HT Annuelle</th>
              <th>Prix HT Semestrielle</th>
              <th>Prix HT Trimestrielle</th>
              <th>Prix HT Mensuelle</th>
              <th>Prix TTC Annuelle</th>
              <th>Prix TTC Semestrielle</th>
              <th>Prix TTC Trimestrielle</th>
              <th>Prix TTC Mensuelle</th>
              <th></th>
            </tr>
          </thead>
          {services.map((service) => (
            <Service
              key={service.idService}
              value={service}
              services={services}
              setServices={setServices}
              setActiveModif={setActiveModif}
              listeServicesModif={listeServicesModif}
              setListeServicesModif={setListeServicesModif}
            />
          ))}
        </table>
      </div>
      <button
        disabled={!activeMofif}
        onClick={modifierServices}
        className="btn-modifier"
      >
        Modifier
      </button>

      <button
        disabled={!activeMofif}
        onClick={annulerServices}
        className="btn-annuler"
      >
        Annuler
      </button>
    </div>
  );
};

export default Services;
