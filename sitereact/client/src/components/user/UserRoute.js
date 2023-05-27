import React from "react";
import { Route, Redirect } from "react-router-dom";
import NavigationUser from "./NavigationUser";

/**
 * Permet de limiter une page pour les users
 */

const UserRoute = ({ component: Component, ...rest }) => {
  return (
    <>
      <NavigationUser />
      <Route
        {...rest}
        render={(props) =>
          localStorage.getItem("idGroupe") === "2" ? (
            <Component {...props} />
          ) : (
            <Redirect to="/" />
          )
        }
      />
    </>
  );
};

export default UserRoute;
