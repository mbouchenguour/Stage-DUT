import React, { useState, useEffect } from "react";
import axios from "axios";
import { useForm } from "react-hook-form";

/**
 * Page permettant d'ajouter une formule
 * @param {*Variable qui permet de faire une redirection après ajout} props
 * @returns Une page avec le formulaire correspondant
 */
const AddFormule = (props) => {
  /**
   * Déclaration du formulaire et des listes(clients, services et facturation)
   */
  const { register, handleSubmit, setValue } = useForm();
  const [listeClients, setListeClients] = useState([]);
  const [listeServices, setListeServices] = useState([]);
  const [listeFacturaction, setListeFacturation] = useState([]);

  /**
   * Ajoute le formulaire à la bdd lors de la validation du formulaire
   * @param {*Les données du formulaire} data
   */
  const onSubmit = (data) => {
    axios.post("https://stage.hofmann.fr/sitereact/server/api/Formules.php", {
      data: data,
    });
    props.history.push("/sitereact/client/");
  };

  /**
   * Initialisation des différentes listes (services, clients, type de facturation)
   */
  useEffect(() => {
    axios
      .get("https://stage.hofmann.fr/sitereact/server/api/Formules.php", {
        params: {
          typeFacturation: 1,
        },
      })
      .then((res) => {
        setValue("typeFacturation", res.data[0].idType);
        setListeFacturation(res.data);
      });

    axios
      .get("https://stage.hofmann.fr/sitereact/server/api/Clients.php")
      .then((res) => {
        res.data.sort(function (a, b) {
          return a.id - b.id;
        });
        setValue("idClient", res.data[0].id);
        setListeClients(res.data);
        let date = new Date();
        setValue("dateSouscription", date.toISOString().split("T")[0]);
        setValue("dateFinService", date.toISOString().split("T")[0]);
      });

    axios
      .get("https://stage.hofmann.fr/sitereact/server/api/Services.php")
      .then((res) => {
        res.data.sort(function (a, b) {
          return a.id - b.id;
        });
        setValue("idService", res.data[0].idService);
        setListeServices(res.data);
      });
  }, []);

  return (
    <div className="ajout-formule">
      <form className="form-add" onSubmit={handleSubmit(onSubmit)}>
        <div className="colonne1">
          <div className="saisie">
            <label htmlFor="idClient">Id du client</label>
            <select
              name="idClient"
              {...register("idClient")}
              className="select-id"
            >
              {listeClients.map((client) => (
                <option key={client.id} value={client.id}>
                  {client.id + " - " + client.nomCompte}
                </option>
              ))}
            </select>
          </div>

          <div className="saisie">
            <label htmlFor="idService">Id du service</label>
            <select
              name="idService"
              {...register("idService")}
              className="select-id"
            >
              {listeServices.map((service) => (
                <option key={service.idService} value={service.idService}>
                  {service.idService + " - " + service.nomService}
                </option>
              ))}
            </select>
          </div>
          <div className="saisie">
            <label htmlFor="typeFacturation">Type de facturation</label>
            <select
              name="typeFacturation"
              {...register("typeFacturation")}
              className="select-id"
            >
              {listeFacturaction.map((facturation) => (
                <option key={facturation.idType} value={facturation.idType}>
                  {facturation.type}
                </option>
              ))}
            </select>
          </div>
        </div>

        <div className="colonne2">
          <div className="saisie">
            <label htmlFor="dateSouscription">Date de Souscription</label>
            <input
              type="date"
              name="dateSouscription"
              {...register("dateSouscription")}
              className="select-date"
            />
          </div>

          <div className="saisie">
            <label htmlFor="dateFinService">Date de fin de service</label>
            <input
              type="date"
              name="dateFinService"
              {...register("dateFinService")}
              className="select-date"
            />
          </div>

          <div className="saisie">
            <label htmlFor="prix">Prix</label>
            <input
              type="number"
              name="prix"
              {...register("prix")}
              className="input-info"
            />
          </div>
        </div>
        <div className="saisie">
          <input type="submit" />
        </div>
      </form>
    </div>
  );
};

export default AddFormule;
