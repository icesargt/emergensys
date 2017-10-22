<div class="form-group {{ ($errors->has('mes')) ? $errors->first('mes') : '' }} col-md-4 col-sm-4 col-lg-3 col-xs-12"> <!-- Columna Izq-->
                    <div class="box-box">
                        <label for="lblFecha" class="control-label control-label-required">Mes:</label>
                        @php
                            $meses = array(
                                '1' => 'Enero',
                                '2' => 'Febrero',
                                '3' => 'Marzo',
                                '4' => 'Abril',
                                '5' => 'Mayo',
                                '6' => 'Junio',
                                '7' => 'Julio',
                                '8' => 'Agosto',
                                '9' => 'Septiembre',
                                '10' => 'Octubre',
                                '11' => 'Noviembre',
                                '12' => 'Diciembre'
                            );
                        @endphp
                            <select class="form-control" name="mes" id="mes">
                                <option value="" disabled selected>Seleccione Mes</option>
                                @foreach($meses as $m => $val)
                                        <option value="{{$m}}">{{$meses[$m]}}</option>
                                @endforeach
                            </select>
                           {!! $errors->first('mes','<p class="help-block">:message</p>') !!}
                        </div>
                </div>



                <div class="form-group {{ ($errors->has('anio')) ? $errors->first('anio') : '' }} col-md-4 col-sm-4 col-lg-3 col-xs-12"> <!-- columna derecha -->
                            <div class="box-box">
                            <label for="lblCantidad" class="control-label control-label-required">Año:</label>
                            <select class="form-control" name="anio" id="anio">
                                <option value="" disabled selected>Seleccione año</option>
                                @php
                                    for($anio=(date("Y")+1); 2012<=$anio; $anio--) {
                                         echo "<option value=$anio>".$anio."</option>";
                                    }
                                @endphp
                            </select>
                            {!! $errors->first('anio','<p class="help-block">:message</p>') !!}
                        </div> <!-- fin columna derecha-->
                     </div>




                     ----

                     <div class="form-group {{ ($errors->has('mes')) ? $errors->first('mes') : '' }} col-md-4 col-sm-4 col-lg-3 col-xs-12"> <!-- Columna Izq-->
                            <div class="box-box">
                            <label for="lblCantidad" class="control-label control-label-required">Mes:</label>
                            @php
                                $meses = array(
                                    '1' => 'Enero',
                                    '2' => 'Febrero',
                                    '3' => 'Marzo',
                                    '4' => 'Abril',
                                    '5' => 'Mayo',
                                    '6' => 'Junio',
                                    '7' => 'Julio',
                                    '8' => 'Agosto',
                                    '9' => 'Septiembre',
                                    '10' => 'Octubre',
                                    '11' => 'Noviembre',
                                    '12' => 'Diciembre'
                                );
                            @endphp
                            <select class="form-control" name="mes" id="mes">
                                <option value="" disabled selected>Seleccione Mes</option>
                                @foreach($meses as $m => $val)
                                    @if($m == $consumos_presupuestos->mes)
                                        <option selected="selected" value="{{$m}}">{{$meses[$m]}}</option>
                                    @else
                                        <option value="{{$m}}">{{$meses[$m]}}</option>
                                    @endif
                                @endforeach
                            </select>
                            {!! $errors->first('mes','<p class="help-block">:message</p>') !!}
                        </div> <!-- Fin Columna Izq-->
                       </div>



                       <div class="form-group {{ ($errors->has('anio')) ? $errors->first('anio') : '' }} col-md-4 col-sm-4 col-lg-3 col-xs-12"> <!-- columna derecha -->
                            <div class="box-box">
                            <label for="lblCantidad" class="control-label control-label-required">Año:</label>
                            <select class="form-control" name="anio" id="anio">
                                <option value="" disabled selected>Seleccione año</option>
                                @php
                                    for($anio=(date("Y")+1); 2012<=$anio; $anio--) {
                                      if($anio == $consumos_presupuestos->anio){
                                         echo "<option selected=\"selected\" value=$anio>".$anio."</option>";
                                        }else{
                                         echo "<option value=$anio>".$anio."</option>";
                                        }
                                    }
                                @endphp
                            </select>
                            {!! $errors->first('anio','<p class="help-block">:message</p>') !!}
                        </div> <!-- fin columna derecha-->
                       </div>