import React from "react";
import { BrowserRouter, Switch, Route } from "react-router-dom";
import AddAssociation from "./pages/admin/AddAssociation";
import AddFormule from "./pages/admin/AddFormule";
import AddParticulier from "./pages/admin/AddParticulier";
import AddProfessionnel from "./pages/admin/AddProfessionnel.js";
import AddService from "./pages/admin/AddService";
import Clients from "./pages/admin/Clients";
import Home from "./pages/admin/Home";
import Historiques from "./pages/admin/Historiques";
import NotFound from "./pages/NotFound";
import Services from "./pages/admin/Services";
import InfoClient from "./pages/admin/InfoClient";
import Login from "./pages/Login";
import axios from "axios";
import Logout from "./pages/Logout";
import ProfilAdmin from "./pages/admin/ProfilAdmin";
import EspaceClient from "./pages/user/EspaceClient";
import AdminRoute from "./components/admin/AdminRoute";
import UserRoute from "./components/user/UserRoute";
import ProfilUser from "./pages/user/ProfilUser";
import EditFormule from "./pages/user/EditFormule";
import Modifications from "./pages/admin/Modifications";
import ConfirmationEdit from "./pages/admin/ConfirmationEdit";
import ServicesClient from "./pages/user/ServicesClient";

/**
 * Permet de définir les différents url nécessaires pour le site
 * @returns
 */
const App = () => {
  const token = localStorage.getItem("user");
  var user = [];

  /**
   * Permet de redirigé vers la page de login si l'utilisateur n'est pas connecté
   */
  if (!token) {
    return <Login />;
  } else {
    axios
      .get("https://stage.hofmann.fr/sitereact/server/api/Login.php", {
        params: {
          token: localStorage.getItem("user"),
        },
      })
      .then((res) => {
        if (!res.data.id) {
          localStorage.removeItem("user");
          window.location.pathname = "/sitereact/client/login";
        } else {
          user = res.data;
        }
      });
  }

  return (
    <BrowserRouter>
      <Switch>
        <AdminRoute path="/sitereact/client/" exact component={Home} />
        <AdminRoute
          path="/sitereact/client/clients"
          exact
          component={Clients}
        />
        <AdminRoute
          path="/sitereact/client/services"
          exact
          component={Services}
        />
        <AdminRoute
          path="/sitereact/client/addAssociation"
          exact
          component={AddAssociation}
        />
        <AdminRoute
          path="/sitereact/client/addParticulier"
          exact
          component={AddParticulier}
        />
        <AdminRoute
          path="/sitereact/client/addProfessionnel"
          exact
          component={AddProfessionnel}
        />
        <AdminRoute
          path="/sitereact/client/addService"
          exact
          component={AddService}
        />
        <AdminRoute
          path="/sitereact/client/addFormule"
          exact
          component={AddFormule}
        />
        <AdminRoute
          path="/sitereact/client/infoClient"
          exact
          component={InfoClient}
        />
        <AdminRoute
          path="/sitereact/client/historiques"
          exact
          component={Historiques}
        />
        <AdminRoute
          path="/sitereact/client/modifications"
          exact
          component={Modifications}
        />

        <AdminRoute
          path="/sitereact/client/confirmations"
          exact
          component={ConfirmationEdit}
        />

        <Route path="/sitereact/client/login" exact component={Login} />
        <Route path="/sitereact/client/logout" exact component={Logout} />

        <AdminRoute
          path="/sitereact/client/profilAdmin"
          exact
          component={ProfilAdmin}
        />
        <UserRoute
          path="/sitereact/client/profilUser"
          exact
          component={ProfilUser}
        />

        <UserRoute
          path="/sitereact/client/espaceClient"
          exact
          component={EspaceClient}
        />

        <UserRoute
          path="/sitereact/client/editFormule"
          exact
          component={EditFormule}
        />

        <UserRoute
          path="/sitereact/client/servicesClient"
          exact
          component={ServicesClient}
        />

        <Route component={NotFound} />
      </Switch>
    </BrowserRouter>
  );
};

export default App;
