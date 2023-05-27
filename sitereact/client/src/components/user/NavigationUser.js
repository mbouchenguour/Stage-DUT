import React from "react";
import { NavLink } from "react-router-dom";
import "../../styles/navigation.css";
import HomeIcon from "@material-ui/icons/Home";
import ExitToAppIcon from "@material-ui/icons/ExitToApp";
import Logo from "../logo-albert-hofmann.png";
import AccounCircleLogo from "@material-ui/icons/AccountCircle";
import ListIcon from "@material-ui/icons/List";

/**
 * Navbar du site coté User
 * @returns Une navbar
 */

const NavigationUser = () => {
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
                to="/sitereact/client/espaceClient"
                activeClassName="nav-active"
              >
                <HomeIcon className="icone" style={{ fontSize: 45 }} />
                <span>Home</span>
              </NavLink>
            </li>

            <li>
              <NavLink
                exact
                to="/sitereact/client/servicesClient"
                activeClassName="nav-active"
              >
                <ListIcon className="icone" style={{ fontSize: 45 }} />
                <span>Services</span>
              </NavLink>
            </li>

            <li>
              <NavLink
                exact
                to="/sitereact/client/profilUser"
                activeClassName="nav-active"
              >
                <AccounCircleLogo className="icone" style={{ fontSize: 45 }} />
                <span>Profil</span>
              </NavLink>
            </li>

            <li>
              <NavLink
                exact
                to="/sitereact/client/logout"
                activeClassName="nav-active"
              >
                <ExitToAppIcon className="icone" style={{ fontSize: 45 }} />
                <span>Déconnexion</span>
              </NavLink>
            </li>
          </ul>
        </nav>
      </header>
    </>
  );
};

export default NavigationUser;
