import { Checkbox, FormControlLabel } from "@material-ui/core";
import React, { useState } from "react";
import ProportionClients from "../../components/admin/statistiques/ProportionClients";
import ProportionNouveauClient from "../../components/admin/statistiques/ProportionNouveauClient";
import ProportionServices from "../../components/admin/statistiques/ProportionServices";
import HistoryIcon from "@material-ui/icons/History";
import { Rnd } from "react-rnd";
import { useHistory } from "react-router-dom";
import "../../styles/home.css";

/**
 * Page principale du site
 * @returns Page principale du site contenant les statistiques
 */
const Home = () => {
  /**
   * Variable permettant de faire des redirections
   */
  const history = useHistory();

  /**
   * Initialise la taille des widgets
   */
  const [taille, setTaille] = useState({
    width: 300,
    height: 300,
    x: 10,
    y: 10,
  });

  const [taille2, setTaille2] = useState({
    width: 300,
    height: 300,
    x: 10,
    y: 10,
  });
  const [taille3, setTaille3] = useState({
    width: 300,
    height: 300,
    x: 10,
    y: 10,
  });

  /**
   * Initialise les checkbox
   */
  const [state, setState] = useState({
    proportionsClients: false,
    proportionServices: false,
    proportionNouveauClient: false,
  });

  /**
   * Permet de (dé)cocher les checkbox
   * @param {*Checkbox a (dé)coher} event 
   */
  const handleChange = (event) => {
    setState({ ...state, [event.target.name]: event.target.checked });
  };


  const style = {
    display: "flex",
    alignItems: "center",
    justifyContent: "center",
    border: "solid 1px #ddd",
    background: "#f0f0f0",
  };

  /**
   * Permet de faire une redirection vers l'historique
   */
  const viewHistory = () => {
    history.push({
      pathname: "/sitereact/client/historiques",
    });
  };

  /**
   * Affiche la page principale contenant les checkbox et les statistiques
   */
  return (
    <>
      <div className="page-home">
        <FormControlLabel
          control={
            <Checkbox
              checked={state.proportionsClients}
              onChange={handleChange}
              name="proportionsClients"
            />
          }
          label="Proportion des clients"
        />
        <FormControlLabel
          control={
            <Checkbox
              checked={state.proportionServices}
              onChange={handleChange}
              name="proportionServices"
            />
          }
          label="Proportion des services"
        />
        <FormControlLabel
          control={
            <Checkbox
              checked={state.proportionNouveauClient}
              onChange={handleChange}
              name="proportionNouveauClient"
            />
          }
          label="Proportion des nouveaux clients"
        />

        <HistoryIcon
          onClick={viewHistory}
          style={{ fontSize: 45 }}
          id="btn-historique"
        />

        {state.proportionsClients && (
          <Rnd
            style={style}
            size={{ width: taille.width, height: taille.height }}
            position={{ x: taille.x, y: taille.y }}
            onDragStop={(e, d) => {
              setTaille({ x: d.x, y: d.y });
            }}
            onResizeStop={(e, direction, ref, delta, position) => {
              setTaille({
                width: ref.style.width,
                height: ref.style.height,
                ...position,
              });
            }}
          >
            <ProportionClients taille={taille} />
          </Rnd>
        )}

        {state.proportionServices && (
          <Rnd
            style={style}
            size={{ width: taille2.width, height: taille2.height }}
            position={{ x: taille2.x, y: taille2.y }}
            onDragStop={(e, d) => {
              setTaille2({ x: d.x, y: d.y });
            }}
            onResizeStop={(e, direction, ref, delta, position) => {
              setTaille2({
                width: ref.style.width,
                height: ref.style.height,
                ...position,
              });
            }}
          >
            <ProportionServices taille={taille2} />
          </Rnd>
        )}

        {state.proportionNouveauClient && (
          <Rnd
            style={style}
            size={{ width: taille3.width, height: taille3.height }}
            position={{ x: taille3.x, y: taille3.y }}
            onDragStop={(e, d) => {
              setTaille3({ x: d.x, y: d.y });
            }}
            onResizeStop={(e, direction, ref, delta, position) => {
              setTaille3({
                width: ref.style.width,
                height: ref.style.height,
                ...position,
              });
            }}
          >
            <ProportionNouveauClient taille={taille3} />
          </Rnd>
        )}
      </div>
    </>
  );
};

export default Home;
