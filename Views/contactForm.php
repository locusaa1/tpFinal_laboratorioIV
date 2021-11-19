<section>
        <h2 class="contactText">Contacto</h2>
        <div class="contact">
            <section>
                <form class="contactForm" action="<?php echo FRONT_ROOT ?>Home/sendContactFormMessage" method="POST">
                    <fieldset>
                        <legend>Contáctanos completando los siguientes campos:</legend>

                        <div class="fields-contactForm-Container">

                            <div class="fields-contactForm">
                                <label>Nombre</label>
                                <input class="input-text" name="name" type="text" placeholder="Nombre" required>
                            </div>

                            <div class="fields-contactForm">
                                <label>Teléfono</label>
                                <input class="input-text" name="number" type="tel" placeholder="Su número sin el 15" required>
                                
                            </div>

                            <div class="fields-contactForm">
                                <label>Correo electrónico</label>
                                <input class="input-text" name="mail" type="email" placeholder="E-mail" required>
                            </div>

                            <div class="fields-contactForm">
                                <label>Mensaje</label>
                                <textarea name="message" class="input-text" required></textarea>
                                
                            </div>

                        </div>

                        <div> 
                            <input class="boton" type="submit" value="Enviar">
                        </div>

                    </fieldset>
                </form>
            </section>    
            <section class="info">
                <p>Teléfonos</p>
                <p>0223 480-5049 / 3479 / 1220</p>
                <p>Correo electrónico</p>
                <p>informes@mdp.utn.edu.ar</p>
                <p>Dirección</p>
                <p>Buque Pesquero Dorrego N° 281</p>
            </section>    
            <section>
                <p class="map"></p>
            </section>
        </div>    
    </section>