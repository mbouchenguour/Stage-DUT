import React, { useEffect, useState } from "react";
import ContentEditable from "react-contenteditable";
import ReplayIcon from "@material-ui/icons/Replay";
import DeleteIcon from "@material-ui/icons/Delete";
import "../../styles/popup.css";

/**
 * Permet d'afficher une formule coté admin sous la forme d'une ligne d'un tableau
 * @param {*La formule ainsi que les différentes variables/fonctions nécessaires} props 
 * @returns une ligne d'un tableau (tbody)
 */

const Formule = (props) => {
  const [formule, setFormule] = useState(props.value);
  const changeFormule = props.changeFormule;
  const deleteFormule = props.deleteFormule;
  const updateFormule = props.updateFormule;

  const listeClients = props.listeClients;
  const listeServices = props.listeServices;
  const listeFacturation = props.listeFacturation;

  const idClient = formule.idClient;
  const idService = formule.idService;
  const typeFacturation = formule.typeFacturation;

  return (
    <>
      <tbody>
        <tr>
          <td>{formule.idFormule}</td>
          <td>
            <select
              name="idClient"
              onChange={(event) => changeFormule(event, formule)}
              value={idClient}
            >
              {listeClients.map((client) => (
                <option key={client.id} value={client.id}>
                  {client.id + " - " + client.nomCompte}
                </option>
              ))}
            </select>
          </td>
          <td>
            <select
              name="idService"
              onChange={(event) => changeFormule(event, formule)}
              value={idService}
            >
              {listeServices.map((service) => (
                <option key={service.idService} value={service.idService}>
                  {service.idService + " - " + service.nomService}
                </option>
              ))}
            </select>
          </td>
          <td>
            <ContentEditable
              html={formule.dateSouscription}
              data-column="dateSouscription"
              onChange={(event) => changeFormule(event, formule)}
            />
          </td>
          <td>
            <ContentEditable
              html={formule.dateFinService}
              data-column="dateFinService"
              onChange={(event) => changeFormule(event, formule)}
            />
          </td>
          <td>
            <select
              name="typeFacturation"
              onChange={(event) => changeFormule(event, formule)}
              value={typeFacturation}
            >
              {listeFacturation.map((facturation) => (
                <option key={facturation.idType} value={facturation.idType}>
                  {facturation.type}
                </option>
              ))}
            </select>
          </td>
          <td>
            <ContentEditable
              html={formule.prix}
              data-column="prix"
              onChange={(event) => changeFormule(event, formule)}
            />
          </td>
          <td>
            <ReplayIcon
              onClick={() => {
                updateFormule(formule);
              }}
            />
          </td>
          <td>
            <DeleteIcon onClick={() => deleteFormule(formule)} />
          </td>
        </tr>
      </tbody>
    </>
  );
};

export default Formule;
