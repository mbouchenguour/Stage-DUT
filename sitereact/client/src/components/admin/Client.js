import React from "react";
import ContentEditable from "react-contenteditable";

import DeleteIcon from "@material-ui/icons/Delete";
import ListIcon from "@material-ui/icons/List";

/**
 * Permet d'afficher un client sous la forme d'une ligne d'un tableau
 * @param {*Le client ainsi que les différentes variables/fonctions nécessaires} props
 * @returns une ligne d'un tableau (tbody)
 */
const Client = (props) => {
  const client = props.value;
  const changeClient = props.changeClient;
  const deleteClient = props.deleteClient;
  const details = props.details;
  const info = props.info;
  const infoClient = props.infoClient;

  return (
    <tbody>
      {client !== 0 && (
        <tr>
          <td>{client.id}</td>
          <td>
            <ContentEditable
              html={client.nomCompte}
              data-column="nomCompte"
              onChange={(event) => changeClient(event, client)}
            />
          </td>
          <td>
            <ContentEditable
              html={client.dateCreation}
              data-column="dateCreation"
              onChange={(event) => changeClient(event, client)}
            />
          </td>
          <td>
            <ContentEditable
              html={client.nom}
              data-column="nom"
              onChange={(event) => changeClient(event, client)}
            />
          </td>
          <td>
            <ContentEditable
              html={client.prenom}
              data-column="prenom"
              onChange={(event) => changeClient(event, client)}
            />
          </td>
          <td>
            <ContentEditable
              html={client.adresse}
              data-column="adresse"
              onChange={(event) => changeClient(event, client)}
            />
          </td>
          <td>
            <ContentEditable
              html={client.cp}
              data-column="cp"
              onChange={(event) => changeClient(event, client)}
            />
          </td>
          <td>
            <ContentEditable
              html={client.ville}
              data-column="ville"
              onChange={(event) => changeClient(event, client)}
            />
          </td>
          <td>
            <ContentEditable
              html={client.pays}
              data-column="pays"
              onChange={(event) => changeClient(event, client)}
            />
          </td>
          <td>
            <ContentEditable
              html={client.mail}
              data-column="mail"
              onChange={(event) => changeClient(event, client)}
            />
          </td>
          <td>
            <ContentEditable
              html={client.telephone}
              data-column="telephone"
              onChange={(event) => changeClient(event, client)}
            />
          </td>
          {details && client.idTypeClient === "1" && (
            <>
              <td>
                <ContentEditable
                  html={client.dateNaissance}
                  data-column="dateNaissance"
                  onChange={(event) => changeClient(event, client)}
                />
              </td>
              <td>
                <ContentEditable
                  html={client.paysNaissance}
                  data-column="paysNaissance"
                  onChange={(event) => changeClient(event, client)}
                />
              </td>
              <td>
                <ContentEditable
                  html={client.villeNaissance}
                  data-column="villeNaissance"
                  onChange={(event) => changeClient(event, client)}
                />
              </td>
            </>
          )}
          {details && client.idTypeClient === "2" && (
            <>
              <td>
                <ContentEditable
                  html={client.nomSociete}
                  data-column="nomSociete"
                  onChange={(event) => changeClient(event, client)}
                />
              </td>
              <td>
                <ContentEditable
                  html={client.siret}
                  data-column="siret"
                  onChange={(event) => changeClient(event, client)}
                />
              </td>
              <td>
                <ContentEditable
                  html={client.codeApe}
                  data-column="codeApe"
                  onChange={(event) => changeClient(event, client)}
                />
              </td>
              <td>
                <ContentEditable
                  html={client.numeroTVA}
                  data-column="numeroTVA"
                  onChange={(event) => changeClient(event, client)}
                />
              </td>
            </>
          )}
          {details && client.idTypeClient === "3" && (
            <>
              <td>
                <ContentEditable
                  html={client.nomAssociation}
                  data-column="nomAssociation"
                  onChange={(event) => changeClient(event, client)}
                />
              </td>
              <td>
                <ContentEditable
                  html={client.dateDeclaration}
                  data-column="dateDeclaration"
                  onChange={(event) => changeClient(event, client)}
                />
              </td>
              <td>
                <ContentEditable
                  html={client.datePublication}
                  data-column="datePublication"
                  onChange={(event) => changeClient(event, client)}
                />
              </td>
              <td>
                <ContentEditable
                  html={client.numeroAnnonce}
                  data-column="numeroAnnonce"
                  onChange={(event) => changeClient(event, client)}
                />
              </td>
            </>
          )}
          <td>{client.typeClient}</td>
          {info && (
            <td>
              <ListIcon
                className="buttonIcon"
                onClick={() => infoClient(client)}
              />
            </td>
          )}
          <td>
            <DeleteIcon
              className="buttonIcon"
              onClick={() => deleteClient(client)}
            />
          </td>
        </tr>
      )}
    </tbody>
  );
};

export default Client;
