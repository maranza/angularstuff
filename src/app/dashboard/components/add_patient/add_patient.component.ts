import { Component, OnInit } from '@angular/core';
import { Patient } from '../../../models/patient';
import { HttpClient } from '@angular/common/http';
import { PatientService } from '../../../services/patient.service';
import { Router } from '@angular/router';
@Component({
  selector: 'app-patient',
  templateUrl: './add_patient.component.html',
  styleUrls: ['./add_patient.component.css']
})
export class AddPatientComponent implements OnInit {
  patient: Patient = new Patient;
  http: HttpClient;
  constructor(private patientService: PatientService, private router: Router) {

    this.patient.firstName = '';
    this.patient.lastName = '';
    this.patient.IdNumber = '';

  }

  ngOnInit() {
  }

  save(): void {

    this.patientService.add(this.patient).subscribe(data => {

        this.router.navigate(['dashboard/view']);
    },
    err => {
        alert(err);
    });

  }
}
