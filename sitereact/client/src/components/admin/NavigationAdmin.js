import React from "react";
import { NavLink } from "react-router-dom";
import "../../styles/navigation.css";
import HomeIcon from "@material-ui/icons/Home";
import ClientAddIcon from "@material-ui/icons/PersonAdd";
import ClientsIcon from "@material-ui/icons/Contacts";
import ExitToAppIcon from "@material-ui/icons/ExitToApp";
import Logo from "../logo-albert-hofmann.png";
import AccounCircleLogo from "@material-ui/icons/AccountCircle";
import ShoppingCartLogo from "@material-ui/icons/ShoppingCart";
import ListIcon from "@material-ui/icons/List";
import BuildIcon from "@material-ui/icons/Build";
import NotificationIcon from "@material-ui/icons/Notifications"

/**
 * Navbar du site coté Admins
 * @returns Une navbar
 */
const NavigationAdmin = () => {
  return (
    <>
      <header>
        <nav>
          <ul className="nav-links">
            <li>
              <div className="logo">
                <img src={Logo} alt="logo" />
              </div>
            </li>
            <li>
              <NavLink
                exact
                to="/sitereact/client/"
                activeClassName="nav-active"
              >
                <HomeIcon className="icone" style={{ fontSize: 45 }}/>
                <span>Home</span>
              </NavLink>
            </li>

            <li>
              <NavLink
                exact
                to="/sitereact/client/clients"
                activeClassName="nav-active"
              >
                <ClientsIcon className="icone" style={{ fontSize: 45 }}/>
                <span>Clients</span>
              </NavLink>
            </li>

            <li className="navbar-ajoutClient">
              <a href="#">
                <ClientAddIcon className="icone" style={{ fontSize: 45 }} />
                <span>Ajout client</span>
              </a>
              <ul className="nav-sous-deroulant">
                <li>
                  <NavLink
                    exact
                    to="/sitereact/client/addParticulier"
                    activeClassName="nav-active"
                  >
                    <span>Particulier</span>
                  </NavLink>
                </li>

                <li>
                  <NavLink
                    exact
                    to="/sitereact/client/addProfessionnel"
                    activeClassName="nav-active"
                  >
                    <span>Professionnel</span>
                  </NavLink>
                </li>
                <li>
                  <NavLink
                    exact
                    to="/sitereact/client/addAssociation"
                    activeClassName="nav-active"
                  >
                    <span>Association</span>
                  </NavLink>
                </li>
              </ul>
            </li>

            <li>
              <NavLink
                exact
                to="/sitereact/client/services"
                activeClassName="nav-active"
              >
                <div className="contenu">
                  <ListIcon className="icone" style={{ fontSize: 45 }}/>
                  <span>Services</span>
                </div>
              </NavLink>
            </li>

            <li>
              <NavLink
                exact
                to="/sitereact/client/addService"
                activeClassName="nav-active"
              >
                <BuildIcon className="icone" style={{ fontSize: 45 }}/>
                <span>Ajout de service</span>
              </NavLink>
            </li>

            <li>
              <NavLink
                exact
                to="/sitereact/client/addFormule"
                activeClassName="nav-active"
              >
                <ShoppingCartLogo className="icone" style={{ fontSize: 45 }}/>
                <span>Ajout formule</span>
              </NavLink>
            </li>

            <li>
              <NavLink
                exact
                to="/sitereact/client/modifications"
                activeClassName="nav-active"
              >
                <NotificationIcon className="icone" style={{ fontSize: 45 }}/>
                <span>Modifications</span>
              </NavLink>
            </li>

            <li>
              <NavLink
                exact
                to="/sitereact/client/profilAdmin"
                activeClassName="nav-active"
              >
                <AccounCircleLogo className="icone" style={{ fontSize: 45 }}/>
                <span>Profil</span>
              </NavLink>
            </li>

            <li>
              <NavLink
                exact
                to="/sitereact/client/logout"
                activeClassName="nav-active"
              >
                <ExitToAppIcon className="icone" style={{ fontSize: 45 }}/>
                <span>Déconnexion</span>
              </NavLink>
            </li>
          </ul>
        </nav>
      </header>
    </>
  );
};

export default NavigationAdmin;
