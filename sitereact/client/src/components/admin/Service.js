import axios from "axios";
import React from "react";
import ContentEditable from "react-contenteditable";
import { confirmAlert } from "react-confirm-alert";
import "react-confirm-alert/src/react-confirm-alert.css";
import DeleteIcon from "@material-ui/icons/Delete";

/**
 * Permet d'afficher un service sous la forme d'une ligne d'un tableau
 * @param {*Le service que l'on souhaite afficher} props 
 * @returns une ligne d'un tableau (tbody)
 */

const Service = (props) => {
  const service = props.value;
  const services = props.services;
  const setServices = props.setServices;
  const listeServicesModif = props.listeServicesModif;
  const setListeServicesModif = props.setListeServicesModif;

  /**
   * Enregistre les modifications à chaque action de l'utilisateur
   * @param {*l'action effectuée par l'utilisateur} event 
   */
  const modifyService = (event) => {
    props.setActiveModif(true);
    const column = event.currentTarget.dataset.column;
    const value = event.target.value;
    service[column] = value;
    let temp = listeServicesModif.findIndex(
      (serviceTemp) => serviceTemp.idService === service.idService
    );
    if (temp === -1) {
      setListeServicesModif((listeServicesModif) => [
        ...listeServicesModif,
        service,
      ]);
    }
  };

  /**
   * Permet de supprimer un service
   * @param {Le service a supprimer} serviceTemp 
   */
  function deleteService(serviceTemp) {
    confirmAlert({
      title: "Confirmation suppression",
      message: "Voulez-vous supprimer ce service ?",
      buttons: [
        {
          label: "Oui",
          onClick: () => {
            axios
              .delete(
                "https://stage.hofmann.fr/sitereact/server/api/Services.php",
                {
                  params: {
                    idService: serviceTemp.idService,
                  },
                }
              )
              .then(() => {
                setServices(
                  services.filter(
                    (service) => service.idService !== serviceTemp.idService
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
  }

  return (
    <tbody>
      <tr>
        <td>{service.idService}</td>
        <td>
          <ContentEditable
            html={service.nomService}
            data-column="nomService"
            onChange={modifyService}
          />
        </td>
        <td>
          <ContentEditable
            html={service.description}
            data-column="description"
            onChange={modifyService}
          />
        </td>
        <td>
          <ContentEditable
            html={service.origine}
            data-column="origine"
            onChange={modifyService}
          />
        </td>
        <td>
          <ContentEditable
            html={service.tauxTVA}
            data-column="tauxTVA"
            onChange={modifyService}
          />
        </td>
        <td>
          <ContentEditable
            html={service.prixHTA}
            data-column="prixHTA"
            onChange={modifyService}
          />
        </td>
        <td>
          <ContentEditable
            html={service.prixHTS}
            data-column="prixHTS"
            onChange={modifyService}
          />
        </td>
        <td>
          <ContentEditable
            html={service.prixHTT}
            data-column="prixHTT"
            onChange={modifyService}
          />
        </td>
        <td>
          <ContentEditable
            html={service.prixHTM}
            data-column="prixHTM"
            onChange={modifyService}
          />
        </td>
        <td>{(service.prixHTA * (service.tauxTVA / 100 + 1)).toFixed(2)}</td>
        <td>{(service.prixHTS * (service.tauxTVA / 100 + 1)).toFixed(2)}</td>
        <td>{(service.prixHTT * (service.tauxTVA / 100 + 1)).toFixed(2)}</td>
        <td>{(service.prixHTM * (service.tauxTVA / 100 + 1)).toFixed(2)}</td>
        <td>
          <DeleteIcon onClick={() => deleteService(service)} />
        </td>
      </tr>
    </tbody>
  );
};

export default Service;
