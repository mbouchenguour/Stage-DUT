import React, { useState, useEffect } from "react";
import axios from "axios";
import { useHistory } from "react-router-dom";

/**
 * Permet de voir les modifications demandées par les clients
 * @returns
 */
const Modifications = () => {
  const history = useHistory();
  const [modifications, setModifications] = useState([]);

  /**
   * Récupére dans la bdd les modfications demandées par les clients
   */
  useEffect(() => {
    axios
      .get("https://stage.hofmann.fr/sitereact/server/api/Modifications.php")
      .then((res) => {
        setModifications(res.data);
      });
  }, []);

  return (
    <div className="page-modifications">
      {modifications.length === 0 ? (
        <h1>Aucune modification demandée</h1>
      ) : (
        <table className="tableau-edit">
          <thead>
            <tr>
              <th>Id</th>
              <th>Numero du client</th>
              <th>Numero du service</th>
              <th>Souscription</th>
              <th>Fin de service</th>
              <th>Facturation</th>
              <th>Prix</th>
            </tr>
          </thead>
          {modifications.map((modification) => (
            <tbody key={modification.idFormule}>
              <tr
                onClick={() =>
                  history.push({
                    pathname: "/sitereact/client/confirmations",
                    state: modification,
                  })
                }
              >
                <td>{modification.idFormule}</td>
                <td>
                  {modification.idClient + " - " + modification.nomCompte}
                </td>
                <td>
                  {modification.idService + " - " + modification.nomService}
                </td>
                <td>{modification.dateSouscription}</td>
                <td>{modification.dateFinService}</td>
                <td>{modification.type}</td>
                <td>{modification.prix}</td>
              </tr>
            </tbody>
          ))}
        </table>
      )}
    </div>
  );
};

export default Modifications;
