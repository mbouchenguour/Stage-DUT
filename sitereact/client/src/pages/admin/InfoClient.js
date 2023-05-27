import React, { useState, useEffect } from "react";
import axios from "axios";
import Formule from "../../components/admin/Formule";
import { confirmAlert } from "react-confirm-alert";
import "react-confirm-alert/src/react-confirm-alert.css";
import { useForm } from "react-hook-form";
import EmailIcon from "@material-ui/icons/Email";
import ContentEditable from "react-contenteditable";
import DeleteIcon from "@material-ui/icons/Delete";
import PersonAdd from "@material-ui/icons/PersonAdd";

/**
 * Page permettant d'afficher les informations d'un client
 */
const InfoClient = (props) => {
  const { register, handleSubmit } = useForm();
  const {
    register: registerMail,
    handleSubmit: handleSubmitMail,
    setValue,
  } = useForm();
  const [client, setClient] = useState(props.location.state);
  const [formules, setFormules] = useState([]);
  const [activeMofif, setActiveModif] = useState(false);
  const [listeFormulesModif, setListeFormulesModif] = useState([]);
  const [idClient, setIdClient] = useState();
  const [idService, setIdService] = useState();
  const [typeFacturation, setTypeFacturation] = useState();
  const [showPopup, setShowPopup] = useState(false);
  const [formuleTemp, setFormuleTemp] = useState([]);
  const [showPopupMail, setShowPopupMail] = useState(false);
  const [listeClients, setListeClients] = useState([]);
  const [listeServices, setListeServices] = useState([]);
  const [listeFacturation, setListeFacturation] = useState([]);
  const [compteCree, setCompteCree] = useState(false);
  const [compteExistant, setCompteExistant] = useState(false);
  const typeClient = client.idTypeClient;

  /**
   * Récupére dans la bdd les formules, les données du client, le mail automatique,
   * et les listes (clients, services, type de facturation)
   */
  useEffect(() => {
    axios
      .get("https://stage.hofmann.fr/sitereact/server/api/Formules.php", {
        params: {
          idClient: client.id,
        },
      })
      .then((res) => {
        setFormules(res.data);
      });

    axios
      .get("https://stage.hofmann.fr/sitereact/server/api/Clients.php", {
        params: {
          id: client.id,
        },
      })
      .then((res) => setClient(res.data));

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
      .get("https://stage.hofmann.fr/sitereact/server/api/Services.php")
      .then((res) => setListeServices(res.data));
    axios
      .get("https://stage.hofmann.fr/sitereact/server/api/Clients.php")
      .then((res) => setListeClients(res.data));

    axios
      .get("https://stage.hofmann.fr/sitereact/server/api/Mails.php", {
        params: {
          idClient: client.id,
        },
      })
      .then((res) => {
        setValue("sujet", res.data[0]);
        setValue("body", res.data[1]);
      });
  }, []);

  /**
   * Permet de confirmer dans la bdd les modifications apportées
   */
  const modifier = () => {
    setActiveModif(false);
    listeFormulesModif.map((formule) => {
      axios.put("https://stage.hofmann.fr/sitereact/server/api/Formules.php", {
        data: formule,
      });
    });
    setFormules(formules.filter((formule) => formule.idClient === client.id));
    axios.put("https://stage.hofmann.fr/sitereact/server/api/Clients.php", {
      data: client,
    });
    setListeFormulesModif([]);
  };

  /**
   * Permet d'annuler les modifications effectuées
   */
  const annuler = () => {
    setActiveModif(false);
    setListeFormulesModif([]);
    axios
      .get("https://stage.hofmann.fr/sitereact/server/api/Formules.php", {
        params: {
          idClient: client.id,
        },
      })
      .then((res) => {
        setFormules(res.data);
      });

    axios
      .get("https://stage.hofmann.fr/sitereact/server/api/Clients.php", {
        params: {
          id: client.id,
        },
      })
      .then((res) => setClient(res.data));
  };

  /**
   * Modifie temporairement une formule et le stocke dans une liste
   * @param {*Modification souhaitée} event
   * @param {*Formule à modifier} formule
   */
  const changeFormule = (event, formule) => {
    setActiveModif(true);
    var column = event.currentTarget.dataset.column;
    const value = event.target.value;
    if (column === undefined) {
      column = event.target.name;
      if (column === "idClient") setIdClient(value);
      else if (column === "idService") setIdService(value);
      else if (column === "typeFacturation") setTypeFacturation(value);
    }
    formule[column] = value;
    setListeFormulesModif((listesFormulesModif) => [
      ...listesFormulesModif,
      formule,
    ]);
  };

  /**
   * Modifie temporairement le client
   * @param {*Modification souhaitée} event
   * @param {*Client à modifier} formule
   */
  const changeClient = (event, client) => {
    setActiveModif(true);
    const column = event.currentTarget.dataset.column;
    const value = event.target.value;
    client[column] = value;
    setClient(client);
  };

  /**
   * Permet de supprimer une formule
   */
  const deleteFormule = (formule) => {
    confirmAlert({
      title: "Confirmation suppression",
      message: "Voulez-vous supprimer cette formule ?",
      buttons: [
        {
          label: "Oui",
          onClick: () => {
            axios
              .delete(
                "https://stage.hofmann.fr/sitereact/server/api/Formules.php",
                {
                  params: {
                    idFormule: formule.idFormule,
                  },
                }
              )
              .then(() => {
                setFormules(
                  formules.filter(
                    (formuleTemp) => formuleTemp.idFormule !== formule.idFormule
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
   * Permet de supprimer un client
   * @param {Client à supprimer} client
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
                props.history.push({
                  pathname: "/sitereact/client/clients",
                });
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
   * Affiche une pop up permettant de renouveller une formule
   * @param {Formule à renouveller} formule
   */
  const updateFormule = (formule) => {
    setShowPopup(true);
    setFormuleTemp(formule);
  };

  /**
   * Renouvelle une formule après validation de la pop up(formulaire)
   */
  const onSubmit = (data) => {
    if (data.typeFacturation === formuleTemp.typeFacturation) {
      setFormuleTemp({
        ...formuleTemp,
        ["prix"]: data.prix,
        ["dateFinService"]: data.dateFinService,
      });
    } else {
      setFormuleTemp({
        ...formuleTemp,
        ["idFormule"]: 0,
        ["typeFacturation"]: data.typeFacturation,
        ["prix"]: data.prix,
        ["dateSouscription"]: formuleTemp.dateFinService,
        ["dateFinService"]: data.dateFinService,
      });
    }
    setShowPopup(false);
  };

  /**
   * Ajoute un mail personnalisé à la bdd après confirmation de la pop up
   * @param {Mail à ajouter} data
   */
  const onSubmitMail = (data) => {
    axios
      .post("https://stage.hofmann.fr/sitereact/server/api/Mails.php", {
        data: {
          idClient: client.id,
          sujet: data.sujet,
          body: data.body,
        },
      })
      .then((res) => {
        setShowPopupMail(false);
      });
  };

  /**
   * Permet de créer un compte client s'il n'existe pas
   */
  const addCompteClient = () => {
    axios
      .get("https://stage.hofmann.fr/sitereact/server/api/Users.php", {
        params: {
          hasAccount: client.id,
        },
      })
      .then((res) => {
        if (res.data === false) {
          axios
            .post("https://stage.hofmann.fr/sitereact/server/api/Users.php", {
              data: { idClient: client.id, email: client.mail },
            })
            .then((res) => {
              setCompteCree(true);
            });
        } else {
          setCompteExistant(true);
        }
      });
  };

  /**
   * Envoie dans la bdd le renouvellement de la formule et remet à jour les formules du client sur le site
   */
  useEffect(() => {
    axios
      .put("https://stage.hofmann.fr/sitereact/server/api/Formules.php", {
        data: formuleTemp,
      })
      .then(() => {
        axios
          .get("https://stage.hofmann.fr/sitereact/server/api/Formules.php", {
            params: {
              idClient: client.id,
            },
          })
          .then((res) => {
            setFormules(res.data);
          });
      });
  }, [formuleTemp]);

  return (
    <>
      <div id="infoClient">
        <div className="partieGauche">
          <table className="tableau-client">
            <thead>
              <DeleteIcon
                className="buttonIcon"
                onClick={() => deleteClient(client)}
              />

              <EmailIcon
                className="buttonIcon"
                onClick={() => setShowPopupMail(true)}
              />

              <PersonAdd className="buttonIcon" onClick={addCompteClient} />
            </thead>
            <tr>
              <th>Identifiant</th>
              <td>{client.id}</td>
            </tr>
            <tr>
              <th>Nom du compte</th>
              <td>
                <ContentEditable
                  html={client.nomCompte}
                  data-column="nomCompte"
                  onChange={(event) => changeClient(event, client)}
                />
              </td>
            </tr>
            <tr>
              <th>Date de création</th>
              <td>
                <ContentEditable
                  html={client.dateCreation}
                  data-column="dateCreation"
                  onChange={(event) => changeClient(event, client)}
                />
              </td>
            </tr>
            <tr>
              <th>Nom</th>
              <td>
                <ContentEditable
                  html={client.nom}
                  data-column="nom"
                  onChange={(event) => changeClient(event, client)}
                />
              </td>
            </tr>
            <tr>
              <th>Prénom</th>
              <td>
                <ContentEditable
                  html={client.prenom}
                  data-column="prenom"
                  onChange={(event) => changeClient(event, client)}
                />
              </td>
            </tr>
            <tr>
              <th>Adresse</th>
              <td>
                <ContentEditable
                  html={client.adresse}
                  data-column="adresse"
                  onChange={(event) => changeClient(event, client)}
                />
              </td>
            </tr>
            <tr>
              <th>Code postal</th>
              <td>
                <ContentEditable
                  html={client.cp}
                  data-column="cp"
                  onChange={(event) => changeClient(event, client)}
                />
              </td>
            </tr>
            <tr>
              <th>Ville</th>
              <td>
                <ContentEditable
                  html={client.ville}
                  data-column="ville"
                  onChange={(event) => changeClient(event, client)}
                />
              </td>
            </tr>
            <tr>
              <th>Pays</th>
              <td>
                <ContentEditable
                  html={client.pays}
                  data-column="pays"
                  onChange={(event) => changeClient(event, client)}
                />
              </td>
            </tr>
            <tr>
              <th>Email</th>
              <td>
                <ContentEditable
                  html={client.mail}
                  data-column="mail"
                  onChange={(event) => changeClient(event, client)}
                />
              </td>
            </tr>
            <tr>
              <th>Téléphone</th>
              <td>
                <ContentEditable
                  html={client.telephone}
                  data-column="telephone"
                  onChange={(event) => changeClient(event, client)}
                />
              </td>
            </tr>
            {typeClient === "1" && (
              <>
                <tr>
                  <th>Date de naissance</th>
                  <td>
                    <ContentEditable
                      html={client.dateNaissance}
                      data-column="dateNaissance"
                      onChange={(event) => changeClient(event, client)}
                    />
                  </td>
                </tr>
                <tr>
                  <th>Pays de naissance</th>
                  <td>
                    <ContentEditable
                      html={client.paysNaissance}
                      data-column="paysNaissance"
                      onChange={(event) => changeClient(event, client)}
                    />
                  </td>
                </tr>
                <tr>
                  <th>Ville de naissance</th>
                  <td>
                    <ContentEditable
                      html={client.villeNaissance}
                      data-column="villeNaissance"
                      onChange={(event) => changeClient(event, client)}
                    />
                  </td>
                </tr>
              </>
            )}
            {typeClient === "2" && (
              <>
                <tr>
                  <th>Nom de Société</th>
                  <td>
                    <ContentEditable
                      html={client.nomSociete}
                      data-column="nomSociete"
                      onChange={(event) => changeClient(event, client)}
                    />
                  </td>
                </tr>
                <tr>
                  <th>Siret</th>
                  <td>
                    <ContentEditable
                      html={client.siret}
                      data-column="siret"
                      onChange={(event) => changeClient(event, client)}
                    />
                  </td>
                </tr>
                <tr>
                  <th>Code APE</th>
                  <td>
                    <ContentEditable
                      html={client.codeApe}
                      data-column="codeApe"
                      onChange={(event) => changeClient(event, client)}
                    />
                  </td>
                </tr>
                <tr>
                  <th>Numero de TVA</th>
                  <td>
                    <ContentEditable
                      html={client.numeroTVA}
                      data-column="numeroTVA"
                      onChange={(event) => changeClient(event, client)}
                    />
                  </td>
                </tr>
              </>
            )}
            {typeClient === "3" && (
              <>
                <tr>
                  <th>Nom de l'Association</th>
                  <td>
                    <ContentEditable
                      html={client.nomAssociation}
                      data-column="nomAssociation"
                      onChange={(event) => changeClient(event, client)}
                    />
                  </td>
                </tr>
                <tr>
                  <th>Date de déclaration</th>
                  <td>
                    <ContentEditable
                      html={client.dateDeclaration}
                      data-column="dateDeclaration"
                      onChange={(event) => changeClient(event, client)}
                    />
                  </td>
                </tr>
                <tr>
                  <th>Date de publication</th>
                  <td>
                    <ContentEditable
                      html={client.datePublication}
                      data-column="datePublication"
                      onChange={(event) => changeClient(event, client)}
                    />
                  </td>
                </tr>
                <tr>
                  <th>Numero annonce</th>
                  <td>
                    <ContentEditable
                      html={client.numeroAnnonce}
                      data-column="numeroAnnonce"
                      onChange={(event) => changeClient(event, client)}
                    />
                  </td>
                </tr>
              </>
            )}
            <tr>
              <th>Type de client</th>
              <td>{client.typeClient}</td>
            </tr>
          </table>
          <button
            type="button"
            disabled={!activeMofif}
            onClick={modifier}
            className="btn-acceptInfoClient"
          >
            Modifier
          </button>

          <button
            type="button"
            disabled={!activeMofif}
            onClick={annuler}
            className="btn-annulerInfoClient"
          >
            Annuler
          </button>
        </div>

        <table className="tableau-formule">
          <thead>
            <tr>
              <th className="colonne-id">Id</th>
              <th>Numero du client</th>
              <th>Numero du service</th>
              <th className="colonne-date">Souscription</th>
              <th className="colonne-date">Fin de service</th>
              <th className="colonne-facturation">Facturation</th>
              <th className="colonne-prix">Prix</th>
              <th className="colonne-logo"></th>
              <th className="colonne-logo"></th>
            </tr>
          </thead>
          {formules.map((formule) => (
            <Formule
              key={formule.idFormule}
              value={formule}
              idService={idService}
              idClient={idClient}
              typeFacturation={typeFacturation}
              changeFormule={changeFormule}
              deleteFormule={deleteFormule}
              updateFormule={updateFormule}
              listeClients={listeClients}
              listeServices={listeServices}
              listeFacturation={listeFacturation}
            />
          ))}
        </table>

        {showPopup && (
          <div className="popupBackground">
            <div className="popupContainer-renouvellement">
              <form className="form-add" onSubmit={handleSubmit(onSubmit)}>
                <label htmlFor="typeFacturation">Type de facturation</label>
                <select name="typeFacturation" {...register("typeFacturation")}>
                  {listeFacturation.map((facturation) => (
                    <option key={facturation.idType} value={facturation.idType}>
                      {facturation.type}
                    </option>
                  ))}
                </select>

                <br />

                <label htmlFor="dateFinService">Date de fin de service</label>
                <input
                  type="date"
                  name="dateFinService"
                  {...register("dateFinService")}
                />

                <br />

                <label htmlFor="prix">Prix</label>
                <input type="number" name="prix" {...register("prix")} />
                <br />
                <br />

                <input type="submit" value="Renouveller" />
                <button onClick={() => setShowPopup(false)}>Annuler</button>
              </form>
            </div>
          </div>
        )}

        {compteCree && (
          <div className="popupBackground-message">
            <div className="popupContainer-message">
              <h1>Le compte a été créé avec succès</h1>
              <button onClick={() => setCompteCree(false)}>Ok</button>
            </div>
          </div>
        )}

        {compteExistant && (
          <div className="popupBackground-message">
            <div className="popupContainer-message">
              <h1>Ce client a déjà un compte</h1>
              <button onClick={() => setCompteExistant(false)}>Ok</button>
            </div>
          </div>
        )}

        {showPopupMail && (
          <div className="popupBackground-mail">
            <div className="popupContainer-mail">
              <form
                className="form-add"
                onSubmit={handleSubmitMail(onSubmitMail)}
              >
                <h1>Modification email du client</h1>
                <label htmlFor="sujet">Sujet</label>
                <input
                  type="text"
                  name="sujet"
                  id="sujet"
                  {...registerMail("sujet")}
                />
                <br />

                <label htmlFor="body">Body</label>
                <textarea
                  name="body"
                  id="body"
                  cols="50"
                  rows="12"
                  {...registerMail("body")}
                ></textarea>

                <br />
                <input type="submit" value="Confirmer" />
                <button onClick={() => setShowPopupMail(false)}>Annuler</button>
                <button
                  onClick={() =>
                    axios
                      .delete(
                        "https://stage.hofmann.fr/sitereact/server/api/Mails.php",
                        {
                          params: {
                            idClient: client.id,
                          },
                        }
                      )
                      .then((res) => {
                        setShowPopupMail(false);
                        setValue("sujet", "");
                        setValue("body", "");
                      })
                  }
                >
                  Supprimer
                </button>
              </form>
            </div>
          </div>
        )}
      </div>
    </>
  );
};

export default InfoClient;
