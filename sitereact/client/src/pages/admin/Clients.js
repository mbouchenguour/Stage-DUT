import React, { useState, useEffect } from "react";
import axios from "axios";
import Client from "../../components/admin/Client";
import "../../styles/tableau.css";
import { FormControlLabel, Checkbox } from "@material-ui/core";
import { confirmAlert } from "react-confirm-alert";
import "react-confirm-alert/src/react-confirm-alert.css";
import { useHistory } from "react-router-dom";
import EmailIcon from "@material-ui/icons/Email";
import { useForm } from "react-hook-form";
import GetApp from "@material-ui/icons/GetApp";

/**
 * Page permettant de visualiser les clients
 * @returns une page avec un tableau des clients
 */
const Clients = () => {
  /**
   * Déclaration des variables stockant les clients
   */
  const [clients, setClients] = useState([]);
  const [activeMofif, setActiveModif] = useState(false);
  /**
   * Variable permettant de stocker la liste des clients modifiés
   */
  const [listeClientsModif, setListeClientsModif] = useState([]);
  /**
   * Variable permettant d'afficher ou non la pop up pour la modification des mails
   */
  const [showPopup, setShowPopup] = useState(false);
  /**
   * Variable permettant de faire une redirection
   */
  const history = useHistory();
  const { register, handleSubmit, setValue } = useForm();

  /**
   * Initialise les checkbox permettant de choisir les types des clients
   */
  const [state, setState] = useState({
    particulier: true,
    professionnel: true,
    association: true,
  });

  /**
   * Permet de (dé)cocher les checkbox
   * @param {*Checkbox (dé)cochée} event
   */
  const handleChange = (event) => {
    setState({ ...state, [event.target.name]: event.target.checked });
  };

  /**
   * Initialise les clients et le mail par défaut
   */
  useEffect(() => {
    axios
      .get("https://stage.hofmann.fr/sitereact/server/api/Clients.php")
      .then((res) => setClients(res.data));

    axios
      .get("https://stage.hofmann.fr/sitereact/server/api/Mails.php")
      .then((res) => {
        setValue("sujet", res.data[0]);
        setValue("body", res.data[1]);
      });
  }, []);

  /**
   * Modifie les clients dans la bdd après les modifications
   */
  const modifierClients = () => {
    setActiveModif(false);
    listeClientsModif.map((client) => {
      axios.put("https://stage.hofmann.fr/sitereact/server/api/Clients.php", {
        data: client,
      });
    });
    setListeClientsModif([]);
  };

  /**
   * Permet d'annuler les modifications
   */
  const annulerClients = () => {
    setListeClientsModif([]);
    setActiveModif(false);
    axios
      .get("https://stage.hofmann.fr/sitereact/server/api/Clients.php")
      .then((res) => {
        setClients(res.data);
      });
  };

  /**
   * Fonction qui permet de supprimer un client
   * @param {*Client à supprimer} client
   */
  const deleteClient = (client) => {
    confirmAlert({
      title: "Confirmation suppression",
      message: "Voulez-vous supprimer ce client ?",
      buttons: [
        {
          label: "Oui",
          onClick: () => {
            axios
              .delete(
                "https://stage.hofmann.fr/sitereact/server/api/Clients.php",
                {
                  params: {
                    id: client.id,
                  },
                }
              )
              .then(() => {
                setClients(
                  clients.filter((clientTemp) => clientTemp.id !== client.id)
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
   * Permet de stocker les clients modifiés à chaque modification
   * @param {Variable contenant la modification} event
   * @param {*Client modifié} client
   */
  const changeClient = (event, client) => {
    setActiveModif(true);

    const column = event.currentTarget.dataset.column;
    const value = event.target.value;
    client[column] = value;

    let temp = listeClientsModif.findIndex(
      (clientTemp) => clientTemp.id === client.id
    );
    if (temp === -1) {
      setListeClientsModif((listesClientsModif) => [
        ...listesClientsModif,
        client,
      ]);
    }
  };

  /**
   * Permet de faire une redirection vers les details d'un client
   * @param {Client que l'on souhaite afficher les détails} client
   */
  const infoClient = (client) => {
    history.push({
      pathname: "/sitereact/client/infoClient",
      state: client,
    });
  };

  /**
   * Permet de modifier dans la bdd le mail par défaut après validation du pop up
   * @param data Données du formulaire pour changer le mail par défaut
   */
  const onSubmit = (data) => {
    console.log(data);
    axios
      .put("https://stage.hofmann.fr/sitereact/server/api/Mails.php", {
        data: data,
      })
      .then((res) => {
        setShowPopup(false);
      });
  };

  /**
   * Permet de lancer le téléchargement du fichier Excel
   */
  const downloadExcel = () => {
    window.open("https://stage.hofmann.fr/sitereact/server/api/Excel.php");
  };

  /**
   * Page avec un tableau contenant les clients
   */
  return (
    <div className="clientsPage">
      <div className="clients">
        <FormControlLabel
          control={
            <Checkbox
              checked={state.particulier}
              onChange={handleChange}
              name="particulier"
            />
          }
          label="Particuliers"
        />
        <FormControlLabel
          control={
            <Checkbox
              checked={state.professionnel}
              onChange={handleChange}
              name="professionnel"
            />
          }
          label="Professionnels"
        />
        <FormControlLabel
          control={
            <Checkbox
              checked={state.association}
              onChange={handleChange}
              name="association"
            />
          }
          label="Associations"
        />
        <br />

        <table className="tableau">
          <thead>
            <tr>
              <th className="colonne-idClient">Id</th>
              <th>Nom du compte</th>
              <th className="colonne-dateClient">Date de création</th>
              <th>Nom</th>
              <th>Prénom</th>
              <th>Adresse</th>
              <th className="colonne-codePostale">Code postal</th>
              <th>Ville</th>
              <th>Pays</th>
              <th>Email</th>
              <th>Téléphone</th>
              <th>Type de client</th>
              <th className="colonne-logo">
                <EmailIcon
                  className="buttonIcon"
                  onClick={() => setShowPopup(true)}
                />
              </th>
              <th className="colonne-logo">
                <GetApp className="buttonIcon" onClick={downloadExcel} />
              </th>
            </tr>
          </thead>
          {clients.map(
            (client) =>
              state[client.typeClient.toLowerCase()] && (
                <Client
                  key={client.id}
                  value={client}
                  deleteClient={deleteClient}
                  changeClient={changeClient}
                  infoClient={infoClient}
                  details={false}
                  info={true}
                />
              )
          )}
        </table>
        <br />
        <br />
      </div>

      <button
        disabled={!activeMofif}
        onClick={modifierClients}
        className="btn-modifier"
      >
        Modifier
      </button>

      <button
        disabled={!activeMofif}
        onClick={annulerClients}
        className="btn-annuler"
      >
        Annuler
      </button>

      {showPopup && (
        <div className="popupBackground-mail">
          <div className="popupContainer-mail">
            <form className="form-add" onSubmit={handleSubmit(onSubmit)}>
              <h1>Modification email de base</h1>
              <label htmlFor="sujet">Sujet</label>
              <input
                type="text"
                name="sujet"
                id="sujet"
                {...register("sujet")}
              />
              <br />

              <label htmlFor="body">Body</label>
              <textarea
                name="body"
                id="body"
                cols="50"
                rows="12"
                {...register("body")}
              ></textarea>

              <br />
              <input type="submit" value="Confirmer" />
              <button onClick={() => setShowPopup(false)}> Annuler</button>
            </form>
          </div>
        </div>
      )}
    </div>
  );
};

export default Clients;
