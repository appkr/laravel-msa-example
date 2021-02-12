package dev.appkr.hello;

import com.tngtech.archunit.core.domain.JavaClasses;
import com.tngtech.archunit.core.importer.ClassFileImporter;
import com.tngtech.archunit.core.importer.ImportOption;
import org.junit.jupiter.api.Test;

import static com.tngtech.archunit.lang.syntax.ArchRuleDefinition.noClasses;

class ArchTest {

    @Test
    void servicesAndRepositoriesShouldNotDependOnWebLayer() {

        JavaClasses importedClasses = new ClassFileImporter()
            .withImportOption(ImportOption.Predefined.DO_NOT_INCLUDE_TESTS)
            .importPackages("dev.appkr.hello");

        noClasses()
            .that()
                .resideInAnyPackage("dev.appkr.hello.service..")
            .or()
                .resideInAnyPackage("dev.appkr.hello.repository..")
            .should().dependOnClassesThat()
                .resideInAnyPackage("..dev.appkr.hello.web..")
        .because("Services and repositories should not depend on web layer")
        .check(importedClasses);
    }
}
