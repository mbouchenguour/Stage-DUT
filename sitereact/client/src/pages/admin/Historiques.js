import React, { useState, useEffect } from "react";
import axios from "axios";
import { confirmAlert } from "react-confirm-alert";
import Historique from "../../components/admin/Historique";

/**
 * Permet d'afficher l'historique des formules
 * @returns une page contenant un tableau avec l'historique
 */
const Historiques = () => {
  const [historiques, setHistoriques] = useState([]);
  const [activeMofif, setActiveModif] = useState(false);
  const [idClient, setIdClient] = useState();
  const [idService, setIdService] = useState();
  const [supprime, setSupprime] = useState();
  const [listeHistoriqueModif, setListeHistoriqueModif] = useState([]);
  const [typeFacturation, setTypeFacturation] = useState();
  const [listeClients, setListeClients] = useState([]);
  const [listeServices, setListeServices] = useState([]);
  const [listeFacturation, setListeFacturation] = useState([]);

  /**
   * Récupére dans la bdd l'historique et les différentes listes (services, clients, type de facturation)
   */
  useEffect(() => {
    axios
      .get("https://stage.hofmann.fr/sitereact/server/api/Services.php")
      .then((res) => setListeServices(res.data));
    axios
      .get("https://stage.hofmann.fr/sitereact/server/api/Clients.php")
      .then((res) => setListeClients(res.data));

    axios
      .get("https://stage.hofmann.fr/sitereact/server/api/Formules.php", {
        params: {
          typeFacturation: 1,
        },
      })
      .then((res) => {
        setListeFacturation(res.data);
      });
    axios
      .get("https://stage.hofmann.fr/sitereact/server/api/Historique.php")
      .then((res) => {
        setHistoriques(res.data);
      });
  }, []);

  /**
   * Modifie temporairement un historique et le stocke dans une liste
   * @param {*Modification souhaitée} event
   * @param {*Historique modifié} historique
   */
  const changeHistorique = (event, historique) => {
    console.log(event);
    setActiveModif(true);
    var column = event.currentTarget.dataset.column;
    const value = event.target.value;
    if (column === undefined) {
      column = event.target.name;
      switch (column) {
        case "supprime":
          setSupprime(value);
          break;
        case "idService":
          setIdService(value);
          break;
        case "typeFacturation":
          setTypeFacturation(value);
          break;
        case "idClient":
          setIdClient(value);
          break;
      }
    }
    historique[column] = value;
    setListeHistoriqueModif((listeHistoriqueModif) => [
      ...listeHistoriqueModif,
      historique,
    ]);
  };

  /**
   * Supprime un historique de la bdd
   * @param {Historique a supprimer} historique
   */
  const deleteHistorique = (historique) => {
    confirmAlert({
      title: "Confirmation suppression",
      message: "Voulez-vous supprimer cette historique ?",
      buttons: [
        {
          label: "Oui",
          onClick: () => {
            axios
              .delete(
                "https://stage.hofmann.fr/sitereact/server/api/Historique.php",
                {
                  params: {
                    idFormule: historique.idFormule,
                  },
                }
              )
              .then(() => {
                setHistoriques(
                  historiques.filter(
                    (historiqueTemp) =>
                      historiqueTemp.idFormule !== historique.idFormule
                  )
                );
              });
          },
        },
        {
          label: "Non",
          onClick: () => {},
        },
      ],
    });
  };

  /**
   * Confirme les modifications dans la bdd
   */
  const modifier = () => {
    setActiveModif(false);
    listeHistoriqueModif.map((historique) => {
      axios.put(
        "https://stage.hofmann.fr/sitereact/server/api/Historique.php",
        {
          data: historique,
        }
      );
    });
    setListeHistoriqueModif([]);
  };

  /**
   * Permet d'annuler les modifications
   */
  const annuler = () => {
    setActiveModif(false);
    axios
      .get("https://stage.hofmann.fr/sitereact/server/api/Historique.php")
      .then((res) => {
        setHistoriques(res.data);
      });
  };

  /**
   * Retourne une page avec un tableau contenant l'historique
   */
  return (
    <>
      <div className="page-Historiques">
        <h1>Historiques</h1>
        <table className="tableau">
          <thead>
            <tr>
              <th className="colonne-id">Identifiant</th>
              <th>Numero du client</th>
              <th>Numero du service</th>
              <th className="colonne-date">Date de souscription</th>
              <th className="colonne-date">Date de fin de service</th>
              <th className="colonne-facturation">Type de facturation</th>
              <th className="colonne-prix">Prix</th>
              <th className="colonne-prix">Supprimé</th>
              <th className="colonne-logo"></th>
            </tr>
          </thead>
          {historiques.map((historique) => (
            <Historique
              key={historique.idHistorique}
              value={historique}
              idService={idService}
              idClient={idClient}
              typeFacturation={typeFacturation}
              changeHistorique={changeHistorique}
              deleteHistorique={deleteHistorique}
              listeClients={listeClients}
              listeServices={listeServices}
              listeFacturation={listeFacturation}
              supprime={supprime}
            />
          ))}
        </table>
        <br />

        <button
          type="button"
          disabled={!activeMofif}
          onClick={modifier}
          className="btn-modifier"
        >
          Modifier
        </button>

        <button
          type="button"
          disabled={!activeMofif}
          onClick={annuler}
          className="btn-annuler"
        >
          Annuler
        </button>
      </div>
    </>
  );
};

export default Historiques;
