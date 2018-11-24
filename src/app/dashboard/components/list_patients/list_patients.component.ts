import { Component, OnInit } from '@angular/core';
import { Patient } from '../../../models/patient';
import { PatientService } from '../../../services/patient.service';
import { Observable } from 'rxjs/Observable';
import { Router } from '@angular/router';
@Component({
  selector: 'app-viewpatient',
  templateUrl: './list_patients.component.html',
  styleUrls: ['./list_patients.component.css']
})
export class ListPatientsComponent implements OnInit {
  patients: Patient[];
  records: Observable<Patient[]>;
  constructor(private patientService: PatientService, private router: Router) { }

  ngOnInit() {

    this.patientService.getRecords().subscribe(data => {
        this.patients = data;
      },
        err => {
          alert(err);
      });
  }
  deletePatient(index: any): void {

    this.patientService.deleteRecord(this.patients[index].uuid).subscribe(data => {
        this.patients.splice(index, 1);
      },
      err => {
        alert(err);
    });

  }

  editPatient(uuid: any): void {

    this.router.navigate(['dashboard/viewpatient/' + uuid]);

  }

}
