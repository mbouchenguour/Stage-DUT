import React, { useState, useEffect } from "react";
import axios from "axios";

const ServicesClient = () => {
  const [services, setServices] = useState([]);

  useEffect(() => {
    axios
      .get("https://stage.hofmann.fr/sitereact/server/api/Services.php")
      .then((res) => {
        setServices(res.data);
      });
  }, []);
  return (
    <div className="servicesClient">
      <table className="tableau">
        <thead>
          <tr>
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
          </tr>
        </thead>
        {services.map((service) => (
          <tbody>
            <tr>
              <td>{service.nomService}</td>
              <td>{service.description}</td>
              <td>{service.origine}</td>
              <td>{service.tauxTVA}</td>
              <td>{service.prixHTA}</td>
              <td>{service.prixHTS}</td>
              <td>{service.prixHTT}</td>
              <td>{service.prixHTM}</td>
              <td>
                {(service.prixHTA * (service.tauxTVA / 100 + 1)).toFixed(2)}
              </td>
              <td>
                {(service.prixHTS * (service.tauxTVA / 100 + 1)).toFixed(2)}
              </td>
              <td>
                {(service.prixHTT * (service.tauxTVA / 100 + 1)).toFixed(2)}
              </td>
              <td>
                {(service.prixHTM * (service.tauxTVA / 100 + 1)).toFixed(2)}
              </td>
            </tr>
          </tbody>
        ))}
      </table>
    </div>
  );
};

export default ServicesClient;
