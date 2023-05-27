import axios from "axios";
import React, { useState, useEffect } from "react";
import { useHistory } from "react-router-dom";
import { useForm } from "react-hook-form";
import Fleche from "../../components/fleche.png";

/**
 * Permet de confirmer une modification demandée par un client
 * @param {Variable contenant la modification à confirmer} props
 * @returns Une page contenant l'ancienne et la nouvelle formule, à confirmer ou refuser
 */
const ConfirmationEdit = (props) => {
  const history = useHistory();
  const [modification, setModification] = useState(props.location.state);
  const [modificationFinale, setModificationFinale] = useState([]);
  const [showPopup, setShowPopup] = useState(false);
  const [formule, setFormule] = useState([]);
  const { register, handleSubmit, setValue } = useForm();

  /**
   * Récupére dans la bdd la modification à confirmer
   */
  useEffect(() => {
    axios
      .get("https://stage.hofmann.fr/sitereact/server/api/Formules.php", {
        params: {
          idFormule: modification.idFormule,
        },
      })
      .then((res) => {
        setFormule(res.data);
        setValue("prix", "0");
      });
  }, []);

  /**
   * Change la formule dans la base de donnée
   * @param data contient le nouveau prix
   */
  const onSubmit = (data) => {
    setModificationFinale({ ...modification, ["prix"]: data.prix });
  };

  /**
   * Permet d'accepeter la modification, change la formule dans la bdd
   */
  useEffect(() => {

    if (modificationFinale.length !== 0) {
      axios
        .put("https://stage.hofmann.fr/sitereact/server/api/Formules.php", {
          data: modificationFinale,
        })
        .then((res) => {
          axios
            .delete(
              "https://stage.hofmann.fr/sitereact/server/api/Modifications.php",
              {
                params: {
                  idFormule: modificationFinale.idFormule,
                },
              }
            )
            .then((res) => {
              history.push("/sitereact/client/");
            });
        });
    }
  }, [modificationFinale]);

  /**
   * Permet de refuser la modification
   */
  const annuler = () => {
    axios
      .delete(
        "https://stage.hofmann.fr/sitereact/server/api/Modifications.php",
        {
          params: {
            idFormule: modification.idFormule,
          },
        }
      )
      .then((res) => {
        history.push("/sitereact/client/");
      });
  };

  return (
    <div className="confirmation-edit">
      <table className="tableau-ancienneFormule">
        <thead>Ancienne formule</thead>
        <tr>
          <th>Identifiant</th>
          <td>{formule.idFormule}</td>
        </tr>

        <tr>
          <th>Numero du client</th>
          <td>{formule.idClient}</td>
        </tr>

        <tr>
          <th>Numero du service</th>
          <td>{formule.idService}</td>
        </tr>

        <tr>
          <th>Date de souscription</th>
          <td>{formule.dateSouscription}</td>
        </tr>

        <tr>
          <th>Date fin de service</th>
          <td>{formule.dateFinService}</td>
        </tr>

        <tr>
          <th>Type de facturation</th>
          <td>{formule.typeFacturationToString}</td>
        </tr>

        <tr>
          <th>Prix</th>
          <td>{formule.prix}</td>
        </tr>
      </table>

      <img src={Fleche} alt="fleche" id="fleche" />

      <table className="tableau-nouvelleFormule">
        <thead>Nouvelle formule</thead>
        <tr>
          <th>Identifiant</th>
          <td>{modification.idFormule}</td>
        </tr>

        <tr>
          <th>Numero du client</th>
          <td>{modification.idClient}</td>
        </tr>

        <tr>
          <th>Numero du service</th>
          <td>{modification.idService}</td>
        </tr>

        <tr>
          <th>Date de souscription</th>
          <td>{modification.dateSouscription}</td>
        </tr>

        <tr>
          <th>Date fin de service</th>
          <td>{modification.dateFinService}</td>
        </tr>

        <tr>
          <th>Type de facturation</th>
          <td>{modification.type}</td>
        </tr>

        <tr>
          <th>Prix</th>
          <td>{modification.prix}</td>
        </tr>
      </table>

      <button
        type="button"
        onClick={() => setShowPopup(true)}
        className="btn-accept"
      >
        Accepter
      </button>
      <button type="button" onClick={annuler} className="btn-refuser">
        Refuser
      </button>

      {showPopup && (
        <div className="popupBackground">
          <div className="popupContainer">
            <form className="form-add" onSubmit={handleSubmit(onSubmit)}>
              <h1>Définir un nouveau prix</h1>
              <input type="number" name="prix" {...register("prix")} />
              <br />
              <input type="submit" value="Confirmer" />
              <button onClick={() => setShowPopup(false)}>Annuler</button>
            </form>
          </div>
        </div>
      )}
    </div>
  );
};

export default ConfirmationEdit;
