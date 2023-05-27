import React from "react";
import { useForm } from "react-hook-form";
import axios from "axios";

/**
 * Page permettant d'ajouter un service
 * @param {*Variable qui permet de faire une redirection après ajout} props
 * @returns Une page avec le formulaire correspondant
 */
const AddService = (props) => {
  /**
   * Déclaration du formulaire
   */
  const { register, handleSubmit } = useForm();

  /**
   * Ajoute un service à la bdd lors de la validation du formulaire
   * @param {*Les données du service} data
   */
  const onSubmit = (data) => {
    axios
      .post("https://stage.hofmann.fr/sitereact/server/api/Services.php", {
        data: data,
      })
      .then((res) => {
        props.history.push("/sitereact/client/services");
      });
  };

  return (
    <div className="ajout-service">
      <form className="form-add" onSubmit={handleSubmit(onSubmit)}>
        <div className="colonne1">
          <div className="saisie">
            <label htmlFor="nomService">Nom du service</label>
            <input type="text" name="nomService" {...register("nomService")} />
          </div>

          <div className="saisie">
            <label htmlFor="description">Description</label>
            <input
              type="text"
              name="description"
              {...register("description")}
            />
          </div>

          <div className="saisie">
            <label htmlFor="origine">Origine</label>
            <input type="text" name="origine" {...register("origine")} />
          </div>

          <div className="saisie">
            <label htmlFor="tauxTVA">Taux de TVA</label>
            <input type="number" name="tauxTVA" {...register("tauxTVA")} />
          </div>
        </div>
        <div className="colonne2">
          <div className="saisie">
            <label htmlFor="prixHTA">Prix HT annuelle</label>
            <input type="number" name="prixHTA" {...register("prixHTA")} />
          </div>

          <div className="saisie">
            <label htmlFor="prixHTS">Prix HT semestrielle</label>
            <input type="number" name="prixHTS" {...register("prixHTS")} />
          </div>

          <div className="saisie">
            <label htmlFor="prixHTT">Prix HT trimestrielle</label>
            <input type="number" name="prixHTT" {...register("prixHTT")} />
          </div>

          <div className="saisie">
            <label htmlFor="prixHTM">Prix HT mensuelle</label>
            <input type="number" name="prixHTM" {...register("prixHTM")} />
          </div>
        </div>

        <div className="saisie">
          <input type="submit" />
        </div>
      </form>
    </div>
  );
};

export default AddService;
