import React from "react";
import { Route, Redirect } from "react-router-dom";
import NavigationAdmin from "./NavigationAdmin";

/**
 * Permet de limiter une page pour les admins
 */
const AdminRoute = ({ component: Component, ...rest }) => {
  return (
    <>
    <NavigationAdmin />
    <Route
      {...rest}
      render={(props) =>
        localStorage.getItem('idGroupe') === '1' ? <Component {...props} /> : <Redirect to="/" />
      }
    />
    </>
  );
};

export default AdminRoute;
