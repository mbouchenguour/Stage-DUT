import React, { useState } from "react";
import "../../styles/formulaire.css";
import { useForm } from "react-hook-form";
import axios from "axios";
import { FormControlLabel, Checkbox } from "@material-ui/core";

/**
 * Page permettant d'ajouter un professionnel
 * @param {*Variable qui permet de faire une redirection après ajout} props
 * @returns Une page avec le formulaire correspondant
 */
const AddProfessionnel = (props) => {
  /**
   * Déclaration du formulaire
   */
  const { register, handleSubmit } = useForm();

  /**
   * Initialise la checkbox pour la création d'un client
   */
  const [state, setState] = useState({
    creation: false,
  });

  /**
   * Permet de (dé)cocher la checkbox pour la création d'un compte client
   * @param {*Checkbox (dé)cochée} event
   */
  const handleChange = (event) => {
    setState({ ...state, [event.target.name]: event.target.checked });
  };

  /**
   * Ajoute un professionnel à la bdd lors de la validation du formulaire
   * @param {*Les données du professionnel} data
   */
  const onSubmit = (data) => {
    axios
      .post(
        "https://stage.hofmann.fr/sitereact/server/api/Professionnels.php",
        {
          data: data,
        }
      )
      .then(() => {
        if (state.creation) {
          console.log(data);
          axios
            .post("https://stage.hofmann.fr/sitereact/server/api/Users.php", {
              data: {
                email: data.mail,
                idClient: data.id,
              },
            })
            .then(() => {
              props.history.push("/sitereact/client/clients");
            });
        } else props.history.push("/sitereact/client/clients");
      });
  };

  /**
   * Une page avec le formulaire d'ajout d'un professionnel
   */
  return (
    <div className="ajout-professionnel">
      <form className="form-add" onSubmit={handleSubmit(onSubmit)}>
        <div className="colonne1">
          <div className="saisie">
            <label htmlFor="id">Identifiant</label>
            <input type="number" name="id" min="0" {...register("id")} />
          </div>

          <div className="saisie">
            <label htmlFor="nomCompte">Nom compte</label>
            <input type="text" name="nomCompte" {...register("nomCompte")} />
          </div>

          <div className="saisie">
            <label htmlFor="dateCreation">Date creation</label>
            <input
              type="date"
              name="dateCreation"
              {...register("dateCreation")}
            />
          </div>

          <div className="saisie">
            <label htmlFor="nom">Nom</label>
            <input type="text" name="nom" {...register("nom")} />
          </div>

          <div className="saisie">
            <label htmlFor="prenom">Prenom</label>
            <input type="text" name="prenom" {...register("prenom")} />
          </div>

          <div className="saisie">
            <label htmlFor="adresse">Adresse</label>
            <input type="text" name="adresse" {...register("adresse")} />
          </div>

          <div className="saisie">
            <label htmlFor="cp">Code postal</label>
            <input type="number" name="cp" min="0" {...register("cp")} />
          </div>

          <div className="saisie">
            <label htmlFor="ville">Ville</label>
            <input type="text" name="ville" {...register("ville")} />
          </div>
        </div>
        <div className="colonne2">
          <div className="saisie">
            <label htmlFor="pays">Pays</label>
            <input type="text" name="pays" {...register("pays")} />
          </div>

          <div className="saisie">
            <label htmlFor="mail">E-mail</label>
            <input type="email" name="mail" {...register("mail")} />
          </div>

          <div className="saisie">
            <label htmlFor="telephone">Téléphone</label>
            <input type="tel" name="telephone" {...register("telephone")} />
          </div>

          <div className="saisie">
            <label htmlFor="nomSociete">Nom de societe</label>
            <input type="text" name="nomSociete" {...register("nomSociete")} />
          </div>

          <div className="saisie">
            <label htmlFor="siret">Siret</label>
            <input type="number" name="siret" {...register("siret")} />
          </div>

          <div className="saisie">
            <label htmlFor="codeApe">Code APE</label>
            <input type="text" name="codeApe" {...register("codeApe")} />
          </div>

          <div className="saisie">
            <label htmlFor="numeroTVA">Numero de TVA</label>
            <input type="text" name="numeroTVA" {...register("numeroTVA")} />
          </div>

          <div className="saisie">
            <FormControlLabel
              control={
                <Checkbox
                  checked={state.creation}
                  onChange={handleChange}
                  name="creation"
                />
              }
              label="Creation"
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

export default AddProfessionnel;
