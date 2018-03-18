import { Component, OnInit } from '@angular/core';
import {Patient} from '../models/patient';
import {HttpClient} from '@angular/common/http';
import {PatientService } from '../services/patient.service';
import {Location} from '@angular/common';
@Component({
  selector: 'app-patient',
  templateUrl: './patient.component.html',
  styleUrls: ['./patient.component.css']
})
export class PatientComponent implements OnInit {
  patient: Patient = new Patient;
  http: HttpClient;
  constructor(private patientService: PatientService,private LocationService : Location) {
    
    this.patient.firstName = '';
    this.patient.lastName = '';
    this.patient.IdNumber = '';

   }
  
  ngOnInit() {
  }

  save(): void {
    
    this.patientService.add(this.patient).subscribe(data => {

        if(data['error']) {

            alert(data['error']);
        }
        else {
          alert(data['success']);
          this.LocationService.go('/view');

        }
    
      }
    
    );

  }
}
