import React from "react";
import NavigationAdmin from "../components/admin/NavigationAdmin";
import NavigationUser from "../components/user/NavigationUser";

/**
 * Page correspondant à un mauvais url
 * @returns 
 */
const NotFound = () => {
  return (
    <>
      {localStorage.getItem("idGroupe") === "1" ? (
        <>
          <NavigationAdmin />
          <div className="NotFound">
            <h1>Not Found</h1>
          </div>
        </>
      ) : (
        <>
          <NavigationUser />
          <div className="NotFound">
            <h1>Not Found</h1>
          </div>
        </>
      )}
    </>
  );
};

export default NotFound;
