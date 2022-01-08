import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PersonalSaludComponent } from './personal-salud.component';

describe('PersonalSaludComponent', () => {
  let component: PersonalSaludComponent;
  let fixture: ComponentFixture<PersonalSaludComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PersonalSaludComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PersonalSaludComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
