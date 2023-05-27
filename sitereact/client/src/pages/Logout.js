import React, { useEffect } from "react";

/**
 * Permet de se déconnecter du site
 * @returns 
 */

const Logout = () => {
  useEffect(() => {
    localStorage.removeItem("user");
    localStorage.removeItem("idGroupe");
    localStorage.removeItem("idMembre");
    localStorage.removeItem("idClient");
    window.location.pathname = "/sitereact/client/login";
  }, []);

  return <h1>Déconnexion en cours</h1>;
};

export default Logout;
