import React from "react";
import EditIcon from "@material-ui/icons/Edit";

/**
 * Permet d'afficher une formule coté user sous la forme d'une ligne d'un tableau
 * @param {*La formule ainsi que les différentes variables/fonctions nécessaires} props 
 * @returns une ligne d'un tableau (tbody)
 */

const Formule = (props) => {
  const formule = props.value;
  const editFormule = props.editFormule;

  return (
    <tbody>
      <tr>
        <td>{formule.nomService}</td>
        <td>{formule.dateSouscription}</td>
        <td>{formule.dateFinService}</td>
        <td>{formule.type}</td>
        <td>{formule.prix}</td>
        <td>
          <EditIcon
            className="buttonIcon"
            onClick={() => editFormule(formule)}
          />
        </td>
      </tr>
    </tbody>
  );
};

export default Formule;
