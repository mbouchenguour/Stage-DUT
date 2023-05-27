import axios from "axios";
import React, { useEffect, useState } from "react";
import { useHistory } from "react-router-dom";
import Formule from "../../components/user/Formule";

/**
 * Page principale des clients contenant les formules
 * @returns Un tableau avec les formules
 */
const EspaceClient = () => {
  const history = useHistory();
  const [client, setClient] = useState([]);
  const [formules, setFormules] = useState([]);

  /**
   * Récupère dans la bdd les formules et les infos du client
   */
  useEffect(() => {
    axios
      .get("https://stage.hofmann.fr/sitereact/server/api/Clients.php", {
        params: {
          id: localStorage.getItem("idClient"),
        },
      })
      .then((res) => {
        setClient(res.data);
      });

    axios
      .get("https://stage.hofmann.fr/sitereact/server/api/Formules.php", {
        params: {
          getFormulesEspaceClient: localStorage.getItem("idClient"),
        },
      })
      .then((res) => {
        setFormules(res.data);
      });
  }, []);

  /**
   * Redirection vers une page afin de modifier une formule
   * @param {*Formule à modifier} formule 
   */
  const editFormule = (formule) => {
    history.push({
      pathname: "/sitereact/client/editFormule",
      state: formule,
    });
  };

  return (
    <div>
      <h1>Bonjour {client.prenom}</h1>
      {formules.length > 0 ? (
        <table className="tableau">
          <thead>
            <tr>
              <th>Nom du service</th>
              <th>Date de souscription</th>
              <th>Date de fin de service</th>
              <th>Type de facturation</th>
              <th>Prix</th>
              <th></th>
            </tr>
          </thead>
          {formules.map((formule) => (
            <Formule
              value={formule}
              key={formule.idFormule}
              editFormule={editFormule}
            />
          ))}
        </table>
      ) : (
        <h2>Vous n'avez pas de formule en cours</h2>
      )}
    </div>
  );
};

export default EspaceClient;
