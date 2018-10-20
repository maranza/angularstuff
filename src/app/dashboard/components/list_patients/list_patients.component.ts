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
    this.records = this.patientService.getRecords();
    this.patientService.getRecords().subscribe(data => {

      if (data['error']) {

        alert('Failed to retrive record');

      } else {

        this.patients = data;
      }

    });
  }
  deletePatient(index: any): void {

    this.patientService.deleteRecord(this.patients[index].uuid).subscribe(data => {

      if (data['error']) {

        alert(data['error']);
      } else {

        this.patients.splice(index, 1);

      }

    });

  }

  editPatient(uuid: any): void {

    this.router.navigate(['dashboard/viewpatient/' + uuid]);

  }

}
