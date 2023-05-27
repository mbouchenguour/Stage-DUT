import React, { useState, useEffect } from "react";
import axios from "axios";
import { useForm } from "react-hook-form";

/**
 * Page affichant un formulaire permettant de modifier les formules coté user
 * @param {*La formule à modifier} props 
 * @returns Un formulaire
 */
const EditFormule = (props) => {
  const [formule, setFormule] = useState(props.location.state);
  const [formuleFin, setFormuleFin] = useState([]);
  const [formuleTemp, setFormuleTemp] = useState([]);
  const { register, handleSubmit, setValue } = useForm();
  const [listeFacturaction, setListeFacturation] = useState([]);

  /**
   * Effectue les modifications dans la bdd après confirmation du formulaire
   * @param {La formule modifiée} data 
   */
  const onSubmit = (data) => {
    setFormuleFin({
      ...formuleTemp,
      ["typeFacturation"]: data.typeFacturation,
      ["dateSouscription"]: data.dateSouscription,
      ["dateFinService"]: data.dateFinService,
    });
  };

  /**
   * Ajoute dans la bdd la formule contenant les modifications souhaitées
   */
  useEffect(() => {
    if (formuleFin.length !== 0) {
      axios
        .post(
          "https://stage.hofmann.fr/sitereact/server/api/Modifications.php",
          {
            data: formuleFin,
          }
        )
        .then((res) => {
          props.history.push("/sitereact/client/espaceClient");
        });
    }
  }, [formuleFin]);

  /**
   * Recupère la liste des types de facturations et initialise le formulaire
   */
  useEffect(() => {
    axios
      .get("https://stage.hofmann.fr/sitereact/server/api/Formules.php", {
        params: {
          typeFacturation: 1,
        },
      })
      .then((res) => {
        setListeFacturation(res.data);
      });

    axios
      .get("https://stage.hofmann.fr/sitereact/server/api/Formules.php", {
        params: {
          idFormule: formule.idFormule,
        },
      })
      .then((res) => {
        setFormuleTemp(res.data);
        setValue("typeFacturation", res.data.typeFacturation);
      });

    setValue("dateSouscription", formule.dateSouscription);
    setValue("dateFinService", formule.dateFinService);
  }, []);

  /**
   * Une page contenant le formulaire
   */
  return (
    <>
      <div className="edit-formule">
        <form className="form-edit" onSubmit={handleSubmit(onSubmit)}>
          <div className="saisie">
            <label htmlFor="typeFacturation">Type de facturation</label>
            <select
              name="typeFacturation"
              {...register("typeFacturation")}
              className="select-id"
            >
              {listeFacturaction.map((facturation) => (
                <option key={facturation.idType} value={facturation.idType}>
                  {facturation.type}
                </option>
              ))}
            </select>
          </div>

          <div className="saisie">
            <label htmlFor="dateSouscription">Date de Souscription</label>
            <input
              type="date"
              name="dateSouscription"
              {...register("dateSouscription")}
              className="select-date"
            />
          </div>

          <div className="saisie">
            <label htmlFor="dateFinService">Date de fin de service</label>
            <input
              type="date"
              name="dateFinService"
              {...register("dateFinService")}
              className="select-date"
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

export default EditFormule;
