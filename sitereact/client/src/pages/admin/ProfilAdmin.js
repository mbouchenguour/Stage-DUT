import axios from "axios";
import React, { useState, useEffect } from "react";
import { useForm } from "react-hook-form";
import "../../styles/profil.css";

/**
 * Page permettant de modifier son mot de passe
 * @returns Une page contenant un formulaire de modification de mot de passe
 */
const Profil = () => {
  const [erreurNonIdentique, setErreurNonIdentique] = useState(false);
  const [mdpIncorrect, setMdpIncorrect] = useState(false);
  const [mdpCourt, setMdpCourt] = useState(false);
  const [user, setUser] = useState([]);
  const [mdpChange, setMdpChange] = useState(false);
  const { register: registerLogin, handleSubmit: handleSubmitLogin } =
    useForm();

  const {
    register,
    handleSubmit,
    formState: { errors },
    setValue,
  } = useForm();

  /**
   * Récupére dans la bdd les informations de l'utilisateur
   */
  useEffect(() => {
    axios
      .get("https://stage.hofmann.fr/sitereact/server/api/Login.php", {
        params: {
          token: localStorage.getItem("user"),
        },
      })
      .then((res) => {
        setUser(res.data);
      });
  }, []);

  /**
   * Permet de modifier dans la bdd le mot de passe si les champs sont remplis correctement
   * @param {*Le nouveau et l'ancien mot de passe} data
   */
  const onSubmit = (data) => {
    setValue("passwordActuel", "");
    setValue("newPassword", "");
    setValue("newPassword2", "");
    axios
      .get("https://stage.hofmann.fr/sitereact/server/api/Users.php", {
        params: {
          idMembre: user.id,
          password: data.passwordActuel,
        },
      })
      .then((res) => {
        var temp = res.data[0];
        if (temp === "False") {
          setMdpIncorrect(true);
          setErreurNonIdentique(false);
          setMdpChange(false);
          setMdpCourt(false);
        } else if (data.newPassword !== data.newPassword2) {
          setErreurNonIdentique(true);
          setMdpIncorrect(false);
          setMdpChange(false);
          setMdpCourt(false);
        } else if (data.newPassword.length < 7) {
          setMdpCourt(true);
          setErreurNonIdentique(false);
          setMdpIncorrect(false);
          setMdpChange(false);
        } else {
          axios.put("https://stage.hofmann.fr/sitereact/server/api/Users.php", {
            data: {
              idMembre: user.id,
              password: data.newPassword,
            },
          });
          setMdpChange(true);
          setMdpIncorrect(false);
          setErreurNonIdentique(false);
          setMdpCourt(false);
        }
      });
  };

  /**
   * Permet de modifier dans la bdd le login
   * @param {*Le nouveau et l'ancien login} data
   */
  const onSubmitLogin = (data) => {
    axios.post("https://stage.hofmann.fr/sitereact/server/api/Users.php", {
      data: {
        idMembre: user.id,
        newLogin: data.newLogin,
      },
    });
  };

  return (
    <>
      <div className="modif-client">
        <form className="form-modif" onSubmit={handleSubmit(onSubmit)}>
          <br />
          <div className="saisie">
            <label htmlFor="passwordActuel">Mot de passe actuel</label>
            <input
              type="password"
              name="passwordActuel"
              {...register("passwordActuel", { required: true })}
            />
          </div>
          <br />
          <div className="saisie">
            <label htmlFor="newPassword">Nouveau mot de passe</label>
            <input
              type="password"
              name="newPassword"
              {...register("newPassword", { required: true })}
            />
          </div>
          <br />

          <div className="saisie">
            <label htmlFor="newPassword2">
              Confirmation du nouveau mot de passe
            </label>
            <input
              type="password"
              name="newPassword2"
              {...register("newPassword2", { required: true })}
            />
          </div>
          <br />
          {(errors.passwordActuel ||
            errors.newPassword ||
            errors.newPassword2) && (
            <span className="erreurs">Tous les champs sont obligatoires</span>
          )}

          {erreurNonIdentique && (
            <span className="erreurs">
              Les mots de passe ne sont pas identiques
            </span>
          )}

          {mdpIncorrect && (
            <span className="erreurs">Mot de passe incorrect</span>
          )}

          {mdpCourt && (
            <span className="erreurs">
              Mot de passe trop court : 7 caractères minimum
            </span>
          )}

          {mdpChange && <span className="valide">Mot de passe modifié</span>}
          <input type="submit" value="Modifier" />
        </form>
      </div>
      <div className="modif-login">
        <form
          className="form-modif"
          onSubmit={handleSubmitLogin(onSubmitLogin)}
        >
          <div className="saisie">
            <label htmlFor="loginActuel">Login actuel</label>
            <input
              type="text"
              name="loginActuel"
              {...registerLogin("loginActuel", { required: true })}
            />
          </div>

          <div className="saisie">
            <label htmlFor="newLogin">Nouveau login</label>
            <input
              type="text"
              name="newLogin"
              {...registerLogin("newLogin", { required: true })}
            />
          </div>

          <div className="saisie">
            <input type="submit" />
          </div>
        </form>
      </div>
    </>
  );
};

export default Profil;
