import axios from "axios";
import React, { useEffect, useState } from "react";
import { useForm } from "react-hook-form";
import "../styles/login.css";
import Logo from "../components/logo-albert-hofmann.png";

/**
 * Page permettant de se connecter au site
 * @returns Un formulaire de connection
 */
const Login = () => {
  const [user, setUser] = useState(0);
  const { register, handleSubmit } = useForm();
  const [mdpIncorrect, setMdpIncorrect] = useState(false);

  /**
   * Permet de se connecter au site si les informations sont correctes
   * @param {*} data
   */
  const onSubmit = (data) => {
    axios
      .get("https://stage.hofmann.fr/sitereact/server/api/Login.php", {
        params: data,
      })
      .then((res) => {
        setUser(res.data);
        if (!res.data.token) {
          setMdpIncorrect(true);
        }
      });
  };

  /**
   * Permet de rediriger vers le site en fonction de l'utilisateur (admin ou client)
   */
  useEffect(() => {
    if (user.token) {
      localStorage.setItem("user", user.token);
      localStorage.setItem("idMembre", user.idMembre);
      localStorage.setItem("idGroupe", user.idGroupe);
      localStorage.setItem("idClient", user.idClient);
      if (user.idGroupe === "1") {
        window.location.pathname = "/sitereact/client/";
      } else {
        window.location.pathname = "/sitereact/client/espaceClient";
      }
    }
  }, [user]);

  return (
    <div className="login-page">
      <div className="logoAH">
        <img src={Logo} alt="logo" />
      </div>
      <span id="text-login">Login</span>
      <form onSubmit={handleSubmit(onSubmit)} id="form-login">
        <input
          name="login"
          id="login"
          type="text"
          {...register("login")}
          placeholder="Identifiant"
        />

        <br />

        <input
          name="password"
          id="password"
          type="password"
          {...register("password")}
          placeholder="Mot de passe"
        />

        <br />

        {mdpIncorrect && (
          <span className="erreurs">Mot de passe incorrect</span>
        )}

        <button type="submit" className="btn-confirmation">
          Se connecter
        </button>
      </form>
    </div>
  );
};

export default Login;
