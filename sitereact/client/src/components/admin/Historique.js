import React, { useEffect, useState } from "react";
import DeleteIcon from "@material-ui/icons/Delete";
import ContentEditable from "react-contenteditable";

/**
 * Permet d'afficher un historique sous la forme d'une ligne d'un tableau
 * @param {*L'historique ainsi que les différentes variables/fonctions nécessaires} props 
 * @returns une ligne d'un tableau (tbody)
 */

const Historique = (props) => {
  const [historique, setHistorique] = useState(props.value);
  const changeHistorique = props.changeHistorique;
  const deleteHistorique = props.deleteHistorique;

  const idClient = historique.idClient;
  const idService = historique.idService;
  const typeFacturation = historique.typeFacturation;

  const listeClients = props.listeClients;
  const listeServices = props.listeServices;
  const listeFacturation = props.listeFacturation;
  const supprime = historique.supprime;

  return (
    <>
      <tbody>
        <tr>
          <td>{historique.idFormule}</td>
          <td>
            <select
              name="idClient"
              onChange={(event) => changeHistorique(event, historique)}
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
              onChange={(event) => changeHistorique(event, historique)}
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
              html={historique.dateSouscription}
              data-column="dateSouscription"
              onChange={(event) => changeHistorique(event, historique)}
            />
          </td>
          <td>
            <ContentEditable
              html={historique.dateFinService}
              data-column="dateFinService"
              onChange={(event) => changeHistorique(event, historique)}
            />
          </td>
          <td>
            <select
              name="typeFacturation"
              onChange={(event) => changeHistorique(event, historique)}
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
              html={historique.prix}
              data-column="prix"
              onChange={(event) => changeHistorique(event, historique)}
            />
          </td>

          <td>
            <select
              name="supprime"
              onChange={(event) => changeHistorique(event, historique)}
              value={supprime}
            >
              <option value="0">Non</option>
              <option value="1">Oui</option>
            </select>
          </td>

          <td>
            <DeleteIcon onClick={() => deleteHistorique(historique)} />
          </td>
        </tr>
      </tbody>
    </>
  );
};

export default Historique;
